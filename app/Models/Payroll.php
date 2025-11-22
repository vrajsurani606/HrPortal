<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'unique_code',
        'month',
        'year',
        'total_working_days',
        'attended_working_days',
        'taken_leave_casual',
        'taken_leave_sick',
        'medical_leave',
        'balance_leave_casual',
        'basic_salary',
        'hra',
        'dearness_allowance',
        'city_allowance',
        'medical_allowance',
        'tiffin_allowance',
        'assistant_allowance',
        'allowances',
        'bonuses',
        'pf',
        'professional_tax',
        'tds',
        'esic',
        'security_deposit',
        'leave_deduction',
        'leave_deduction_days',
        'deductions',
        'tax',
        'net_salary',
        'payment_date',
        'payment_method',
        'bank_name',
        'bank_account_no',
        'ifsc_code',
        'account_holder_name',
        'transaction_no',
        'payment_remarks',
        'status',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'basic_salary' => 'decimal:2',
        'allowances' => 'decimal:2',
        'bonuses' => 'decimal:2',
        'deductions' => 'decimal:2',
        'tax' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    /**
     * Get the employee that owns the payroll.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Calculate net salary
     */
    public function calculateNetSalary()
    {
        $gross = $this->basic_salary + $this->allowances + $this->bonuses;
        $this->net_salary = $gross - $this->deductions - $this->tax;
        return $this->net_salary;
    }
}
