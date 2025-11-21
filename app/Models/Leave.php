<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'status',
        'approved_by',
        'approved_at',
        'remarks',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
        'total_days' => 'integer',
    ];

    /**
     * Get the employee that owns the leave.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the user who approved the leave.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
