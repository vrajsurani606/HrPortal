<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'year',
        'paid_leave_total',
        'paid_leave_used',
        'paid_leave_balance',
        'casual_leave_used',
        'medical_leave_used',
        'personal_leave_used',
        'holiday_leave_used',
        'january_paid_used', 'february_paid_used', 'march_paid_used',
        'april_paid_used', 'may_paid_used', 'june_paid_used',
        'july_paid_used', 'august_paid_used', 'september_paid_used',
        'october_paid_used', 'november_paid_used', 'december_paid_used',
        'q1_rollover', 'q2_rollover', 'q3_rollover', 'q4_rollover',
    ];

    protected $casts = [
        'year' => 'integer',
        'paid_leave_total' => 'decimal:1',
        'paid_leave_used' => 'decimal:1',
        'paid_leave_balance' => 'decimal:1',
        'casual_leave_used' => 'decimal:1',
        'medical_leave_used' => 'decimal:1',
        'personal_leave_used' => 'decimal:1',
        'holiday_leave_used' => 'decimal:1',
    ];

    /**
     * Get the employee that owns the leave balance.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Initialize leave balance for an employee for a given year
     */
    public static function initializeForEmployee($employeeId, $year = null)
    {
        $year = $year ?? now()->year;
        
        return static::firstOrCreate(
            ['employee_id' => $employeeId, 'year' => $year],
            [
                'paid_leave_total' => 12,
                'paid_leave_used' => 0,
                'paid_leave_balance' => 12,
                'casual_leave_used' => 0,
                'medical_leave_used' => 0,
                'personal_leave_used' => 0,
                'holiday_leave_used' => 0,
            ]
        );
    }

    /**
     * Deduct leave from balance
     */
    public function deductLeave($leaveType, $days)
    {
        switch ($leaveType) {
            case 'casual':
                // Deduct from shared paid leave pool
                $this->paid_leave_used += $days;
                $this->paid_leave_balance = $this->paid_leave_total - $this->paid_leave_used;
                // Track casual separately for reporting
                $this->casual_leave_used += $days;
                break;
            case 'medical':
                // Deduct from shared paid leave pool
                $this->paid_leave_used += $days;
                $this->paid_leave_balance = $this->paid_leave_total - $this->paid_leave_used;
                // Track medical separately for reporting
                $this->medical_leave_used += $days;
                break;
            case 'personal':
                // Unpaid leave - just track usage
                $this->personal_leave_used += $days;
                break;
            case 'holiday':
                // Unpaid leave - just track usage
                $this->holiday_leave_used += $days;
                break;
        }
        $this->save();
    }

    /**
     * Restore leave to balance (when leave is rejected or cancelled)
     */
    public function restoreLeave($leaveType, $days)
    {
        switch ($leaveType) {
            case 'casual':
                // Restore to shared paid leave pool
                $this->paid_leave_used = max(0, $this->paid_leave_used - $days);
                $this->paid_leave_balance = $this->paid_leave_total - $this->paid_leave_used;
                // Update casual tracking
                $this->casual_leave_used = max(0, $this->casual_leave_used - $days);
                break;
            case 'medical':
                // Restore to shared paid leave pool
                $this->paid_leave_used = max(0, $this->paid_leave_used - $days);
                $this->paid_leave_balance = $this->paid_leave_total - $this->paid_leave_used;
                // Update medical tracking
                $this->medical_leave_used = max(0, $this->medical_leave_used - $days);
                break;
            case 'personal':
                $this->personal_leave_used = max(0, $this->personal_leave_used - $days);
                break;
            case 'holiday':
                $this->holiday_leave_used = max(0, $this->holiday_leave_used - $days);
                break;
        }
        $this->save();
    }

    /**
     * Check if employee has sufficient leave balance
     */
    public function hasSufficientBalance($leaveType, $days)
    {
        switch ($leaveType) {
            case 'casual':
            case 'medical':
                // Both use the same paid leave pool
                return $this->paid_leave_balance >= $days;
            case 'personal':
            case 'holiday':
                return true; // Unpaid leave has no limit
            default:
                return false;
        }
    }

    /**
     * Get current month name
     */
    public static function getCurrentMonthColumn()
    {
        $months = [
            1 => 'january', 2 => 'february', 3 => 'march', 4 => 'april',
            5 => 'may', 6 => 'june', 7 => 'july', 8 => 'august',
            9 => 'september', 10 => 'october', 11 => 'november', 12 => 'december'
        ];
        return $months[now()->month] . '_paid_used';
    }

    /**
     * Get current quarter
     */
    public static function getCurrentQuarter()
    {
        $month = now()->month;
        if ($month <= 3) return 1;
        if ($month <= 6) return 2;
        if ($month <= 9) return 3;
        return 4;
    }

    /**
     * Get current quarter column name
     */
    public static function getCurrentQuarterColumn()
    {
        return 'q' . self::getCurrentQuarter() . '_rollover';
    }

    /**
     * Get month column name by month number
     */
    public static function getMonthColumn($month)
    {
        $months = [
            1 => 'january', 2 => 'february', 3 => 'march', 4 => 'april',
            5 => 'may', 6 => 'june', 7 => 'july', 8 => 'august',
            9 => 'september', 10 => 'october', 11 => 'november', 12 => 'december'
        ];
        return $months[$month] . '_paid_used';
    }

    /**
     * Get available paid leave for current month
     */
    public function getMonthlyAvailable()
    {
        $monthColumn = self::getCurrentMonthColumn();
        $monthUsed = $this->$monthColumn ?? 0;
        
        // Calculate quarterly rollover first
        $this->calculateQuarterlyRollover();
        
        $quarterColumn = self::getCurrentQuarterColumn();
        $quarterRollover = $this->$quarterColumn ?? 0;
        
        // 1 paid leave per month + any rollover from previous months in quarter
        $available = (1 + $quarterRollover) - $monthUsed;
        return max(0, $available);
    }

    /**
     * Get available paid leave for specific month
     */
    public function getMonthlyAvailableForMonth($month)
    {
        $monthColumn = self::getMonthColumn($month);
        $monthUsed = $this->$monthColumn ?? 0;
        
        // Determine quarter for this month
        if ($month <= 3) $quarter = 1;
        elseif ($month <= 6) $quarter = 2;
        elseif ($month <= 9) $quarter = 3;
        else $quarter = 4;
        
        $quarterColumn = 'q' . $quarter . '_rollover';
        $quarterRollover = $this->$quarterColumn ?? 0;
        
        return max(0, (1 + $quarterRollover) - $monthUsed);
    }

    /**
     * Get monthly breakdown for display
     */
    public function getMonthlyBreakdown()
    {
        $breakdown = [];
        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        
        foreach ($months as $month => $name) {
            $column = self::getMonthColumn($month);
            $used = $this->$column ?? 0;
            $available = $this->getMonthlyAvailableForMonth($month);
            
            $breakdown[$month] = [
                'name' => $name,
                'used' => $used,
                'available' => $available,
                'total' => 1,
                'is_current' => now()->month == $month
            ];
        }
        
        return $breakdown;
    }

    /**
     * Get quarterly breakdown
     */
    public function getQuarterlyBreakdown()
    {
        $quarters = [
            1 => ['name' => 'Q1 (Jan-Mar)', 'months' => [1, 2, 3]],
            2 => ['name' => 'Q2 (Apr-Jun)', 'months' => [4, 5, 6]],
            3 => ['name' => 'Q3 (Jul-Sep)', 'months' => [7, 8, 9]],
            4 => ['name' => 'Q4 (Oct-Dec)', 'months' => [10, 11, 12]],
        ];
        
        $breakdown = [];
        foreach ($quarters as $q => $data) {
            $used = 0;
            foreach ($data['months'] as $month) {
                $column = self::getMonthColumn($month);
                $used += $this->$column ?? 0;
            }
            
            $rolloverColumn = 'q' . $q . '_rollover';
            $rollover = $this->$rolloverColumn ?? 0;
            $available = (3 + $rollover) - $used; // 3 months = 3 paid leaves
            
            $breakdown[$q] = [
                'name' => $data['name'],
                'used' => $used,
                'available' => max(0, $available),
                'rollover' => $rollover,
                'total' => 3 + $rollover,
                'is_current' => self::getCurrentQuarter() == $q
            ];
        }
        
        return $breakdown;
    }

    /**
     * Deduct monthly paid leave
     */
    public function deductMonthlyPaidLeave($leaveType, $days, $month = null)
    {
        $month = $month ?? now()->month;
        $monthColumn = self::getMonthColumn($month);
        
        // Check if monthly limit exceeded
        $currentUsed = $this->$monthColumn ?? 0;
        if ($currentUsed + $days > 1) {
            return false; // Cannot exceed 1 paid leave per month
        }
        
        // Update monthly usage
        $this->$monthColumn = $currentUsed + $days;
        
        // Update overall tracking
        $this->paid_leave_used += $days;
        $this->paid_leave_balance = $this->paid_leave_total - $this->paid_leave_used;
        
        if ($leaveType === 'casual') {
            $this->casual_leave_used += $days;
        } elseif ($leaveType === 'medical') {
            $this->medical_leave_used += $days;
        }
        
        $this->save();
        return true;
    }

    /**
     * Calculate quarterly rollover (unused leaves from previous months)
     */
    public function calculateQuarterlyRollover()
    {
        $currentQuarter = self::getCurrentQuarter();
        $currentMonth = now()->month;
        
        // Determine which months have passed in current quarter
        if ($currentQuarter == 1) $quarterMonths = [1, 2, 3];
        elseif ($currentQuarter == 2) $quarterMonths = [4, 5, 6];
        elseif ($currentQuarter == 3) $quarterMonths = [7, 8, 9];
        else $quarterMonths = [10, 11, 12];
        
        $totalAvailable = 0;
        $totalUsed = 0;
        
        foreach ($quarterMonths as $month) {
            if ($month < $currentMonth) {
                // Past months in this quarter
                $column = self::getMonthColumn($month);
                $used = $this->$column ?? 0;
                $totalAvailable += 1;
                $totalUsed += $used;
            }
        }
        
        // Rollover = unused leaves from past months
        $rollover = max(0, $totalAvailable - $totalUsed);
        
        $quarterColumn = 'q' . $currentQuarter . '_rollover';
        $this->$quarterColumn = $rollover;
        $this->save();
        
        return $rollover;
    }
}
