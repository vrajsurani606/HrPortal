<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'check_in',
        'check_out',
        'total_working_hours',
        'status',
        'notes',
        'check_in_ip',
        'check_out_ip',
        'check_in_location',
        'check_out_location',
    ];

    protected $casts = [
        'date' => 'date',
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function calculateWorkingHours(): ?string
    {
        if ($this->check_in && $this->check_out) {
            $checkIn = \Carbon\Carbon::parse($this->check_in);
            $checkOut = \Carbon\Carbon::parse($this->check_out);
            
            // Calculate total minutes
            $totalMinutes = $checkIn->diffInMinutes($checkOut);
            
            // Convert to hours and minutes (e.g., 8:30 for 8 hours and 30 minutes)
            $hours = floor($totalMinutes / 60);
            $minutes = $totalMinutes % 60;
            
            return sprintf('%02d:%02d:00', $hours, $minutes);
        }
        
        return null;
    }

    /**
     * Calculate overtime based on standard 8-hour workday
     */
    public function calculateOvertime(): ?string
    {
        if ($this->check_in && $this->check_out) {
            $checkIn = \Carbon\Carbon::parse($this->check_in);
            $checkOut = \Carbon\Carbon::parse($this->check_out);
            
            $totalMinutes = $checkIn->diffInMinutes($checkOut);
            $standardMinutes = 8 * 60; // 8 hours = 480 minutes
            
            if ($totalMinutes > $standardMinutes) {
                $overtimeMinutes = $totalMinutes - $standardMinutes;
                $hours = floor($overtimeMinutes / 60);
                $minutes = $overtimeMinutes % 60;
                
                return sprintf('%dh %dm', $hours, $minutes);
            }
        }
        
        return '--';
    }

    /**
     * Auto-calculate attendance status based on check-in/out times
     * Rules:
     * - Office hours: 9:30 AM to 6:30 PM (9 hours with 1 hour break = 8 hours work)
     * - Late: Check-in after 9:45 AM
     * - Early Leave: Check-out before 6:00 PM
     * - Half Day: Less than 4 hours worked
     * - Present: 6+ hours worked
     * - Absent: No check-in
     */
    public function autoCalculateStatus(): string
    {
        // If no check-in, mark as absent
        if (!$this->check_in) {
            return 'absent';
        }

        $checkIn = \Carbon\Carbon::parse($this->check_in);
        $standardCheckIn = \Carbon\Carbon::parse($this->date)->setTime(9, 30); // 9:30 AM
        $lateThreshold = \Carbon\Carbon::parse($this->date)->setTime(9, 45); // 9:45 AM
        
        // If no check-out yet, consider as present (still working)
        if (!$this->check_out) {
            // Check if late
            if ($checkIn->greaterThan($lateThreshold)) {
                return 'late';
            }
            return 'present';
        }

        $checkOut = \Carbon\Carbon::parse($this->check_out);
        $standardCheckOut = \Carbon\Carbon::parse($this->date)->setTime(18, 30); // 6:30 PM
        $earlyLeaveThreshold = \Carbon\Carbon::parse($this->date)->setTime(18, 0); // 6:00 PM
        
        // Calculate working hours
        $workedMinutes = $checkIn->diffInMinutes($checkOut);
        $workedHours = $workedMinutes / 60;

        // Determine status based on worked hours and timing
        if ($workedHours < 4) {
            return 'half_day';
        } elseif ($workedHours >= 6) {
            // Check if came late
            if ($checkIn->greaterThan($lateThreshold)) {
                return 'late';
            }
            // Check if left early
            if ($checkOut->lessThan($earlyLeaveThreshold)) {
                return 'early_leave';
            }
            return 'present';
        } else {
            // Between 4-6 hours
            return 'half_day';
        }
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'present' => 'badge--success',
            'absent' => 'badge--danger',
            'half_day' => 'badge--warning',
            'late' => 'badge--warning',
            'early_leave' => 'badge--warning',
            default => 'badge--secondary',
        };
    }

    /**
     * Get status display text
     */
    public function getStatusText(): string
    {
        return match($this->status) {
            'present' => 'Present',
            'absent' => 'Absent',
            'half_day' => 'Half Day',
            'late' => 'Late',
            'early_leave' => 'Early Leave',
            default => ucfirst($this->status ?? 'Unknown'),
        };
    }
}
