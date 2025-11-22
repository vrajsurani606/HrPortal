<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PayrollController extends Controller
{
    public function index(Request $request): View
    {
        $query = Payroll::with('employee');

        // Filter by month
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by employee
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // Search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->whereHas('employee', function($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('code', 'like', "%{$q}%");
            });
        }

        $payrolls = $query->orderByDesc('year')
                          ->orderByDesc('created_at')
                          ->paginate(25)
                          ->appends($request->query());

        $employees = Employee::orderBy('name')->get();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 
                   'July', 'August', 'September', 'October', 'November', 'December'];
        $years = range(date('Y'), date('Y') - 5);

        return view('payroll.index', compact('payrolls', 'employees', 'months', 'years'));
    }

    public function create(): View
    {
        $employees = Employee::orderBy('name')->get();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 
                   'July', 'August', 'September', 'October', 'November', 'December'];
        
        return view('payroll.create', compact('employees', 'months'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|string',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'bonuses' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string',
            'status' => 'required|in:pending,paid,cancelled',
            'notes' => 'nullable|string',
        ]);

        // Calculate net salary
        $basicSalary = $request->basic_salary ?? 0;
        $allowances = $request->allowances ?? 0;
        $bonuses = $request->bonuses ?? 0;
        $deductions = $request->deductions ?? 0;
        $tax = $request->tax ?? 0;
        
        $netSalary = ($basicSalary + $allowances + $bonuses) - ($deductions + $tax);

        $payroll = Payroll::create([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'basic_salary' => $basicSalary,
            'allowances' => $allowances,
            'bonuses' => $bonuses,
            'deductions' => $deductions,
            'tax' => $tax,
            'net_salary' => $netSalary,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Payroll created successfully!',
                'payroll' => $payroll
            ]);
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll created successfully!');
    }

    public function edit($id)
    {
        $payroll = Payroll::findOrFail($id);
        $employees = Employee::orderBy('name')->get();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 
                   'July', 'August', 'September', 'October', 'November', 'December'];

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'payroll' => $payroll
            ]);
        }

        return view('payroll.edit', compact('payroll', 'employees', 'months'));
    }

    public function update(Request $request, $id)
    {
        $payroll = Payroll::findOrFail($id);

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|string',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'bonuses' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string',
            'status' => 'required|in:pending,paid,cancelled',
            'notes' => 'nullable|string',
        ]);

        // Calculate net salary
        $basicSalary = $request->basic_salary ?? 0;
        $allowances = $request->allowances ?? 0;
        $bonuses = $request->bonuses ?? 0;
        $deductions = $request->deductions ?? 0;
        $tax = $request->tax ?? 0;
        
        $netSalary = ($basicSalary + $allowances + $bonuses) - ($deductions + $tax);

        $payroll->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'basic_salary' => $basicSalary,
            'allowances' => $allowances,
            'bonuses' => $bonuses,
            'deductions' => $deductions,
            'tax' => $tax,
            'net_salary' => $netSalary,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Payroll updated successfully!',
                'payroll' => $payroll
            ]);
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll updated successfully!');
    }

    public function show($id)
    {
        $payroll = Payroll::with('employee')->findOrFail($id);
        return view('payroll.show', compact('payroll'));
    }

    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Payroll deleted successfully!'
            ]);
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll deleted successfully!');
    }

    /**
     * Get employee salary details for auto-fill
     */
    public function getEmployeeSalary(Request $request)
    {
        try {
            $employeeId = $request->employee_id;
            $month = $request->month ?? date('F');
            $year = $request->year ?? date('Y');

            $employee = Employee::findOrFail($employeeId);
            
            // Get employee's basic salary from current_offer_amount field
            $basicSalary = $employee->current_offer_amount ?? 0;
            
            // Calculate working days in month
            $monthNumber = date('n', strtotime($month . ' 1'));
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $year);
            
            // Get leave data from leave system
            // Casual Leave (Paid - NO deduction from salary)
            $casualLeaveUsed = \App\Models\Leave::where('employee_id', $employeeId)
                ->where('leave_type', 'casual')
                ->where('status', 'approved')
                ->whereYear('start_date', $year)
                ->whereMonth('start_date', $monthNumber)
                ->sum('total_days') ?? 0;
            
            // Medical Leave (Paid - NO deduction from salary)
            $medicalLeaveUsed = \App\Models\Leave::where('employee_id', $employeeId)
                ->where('leave_type', 'medical')
                ->where('status', 'approved')
                ->whereYear('start_date', $year)
                ->whereMonth('start_date', $monthNumber)
                ->sum('total_days') ?? 0;
            
            // Personal Leave (Unpaid - WILL BE DEDUCTED from salary)
            $personalLeaveUsed = \App\Models\Leave::where('employee_id', $employeeId)
                ->where('leave_type', 'personal')
                ->where('status', 'approved')
                ->whereYear('start_date', $year)
                ->whereMonth('start_date', $monthNumber)
                ->sum('total_days') ?? 0;
            
            // Holiday Leave (Company holidays)
            $holidayLeaveUsed = \App\Models\Leave::where('employee_id', $employeeId)
                ->where('leave_type', 'holiday')
                ->where('status', 'approved')
                ->whereYear('start_date', $year)
                ->whereMonth('start_date', $monthNumber)
                ->sum('total_days') ?? 0;
            
            // Total paid leaves (Casual + Medical) - NOT deducted
            $paidLeavesUsed = $casualLeaveUsed + $medicalLeaveUsed;
            
            // Only personal leave is deducted from salary
            $leaveDaysDeducted = $personalLeaveUsed;
            
            // Calculate per day salary based on current_offer_amount
            $perDaySalary = $daysInMonth > 0 ? $basicSalary / $daysInMonth : 0;
            
            // Calculate leave deduction (ONLY for personal leave)
            $leaveDeduction = $perDaySalary * $leaveDaysDeducted;
            
            // Calculate working days (excluding all leaves)
            $totalLeaveDays = $paidLeavesUsed + $leaveDaysDeducted + $holidayLeaveUsed;
            $workingDays = $daysInMonth - $totalLeaveDays;
            
            // Get leave balance for the year
            $leaveBalance = \App\Models\LeaveBalance::where('employee_id', $employeeId)
                ->where('year', $year)
                ->first();
            
            $paidLeaveBalance = $leaveBalance ? ($leaveBalance->paid_leave_balance ?? 12) : 12;
            
            \Log::info('Payroll Employee Data Loaded', [
                'employee_id' => $employeeId,
                'month' => $month,
                'year' => $year,
                'casual_leave' => $casualLeaveUsed,
                'medical_leave' => $medicalLeaveUsed,
                'personal_leave' => $personalLeaveUsed,
                'holiday_leave' => $holidayLeaveUsed,
            ]);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'emp_code' => $employee->code ?? '',
                    'bank_name' => $employee->bank_name ?? '',
                    'bank_account_no' => $employee->bank_account_no ?? '',
                    'ifsc_code' => $employee->bank_ifsc ?? '',
                    'basic_salary' => number_format($basicSalary, 2, '.', ''),
                    
                    // Leave data - keep decimals for accurate leave counting (e.g., 7.5 days)
                    'casual_leave_used' => (int)$casualLeaveUsed,
                    'medical_leave_used' => (int)$medicalLeaveUsed,
                    'personal_leave_used' => (float)$personalLeaveUsed, // Keep decimal (7.5, etc)
                    'holiday_leave_used' => (int)$holidayLeaveUsed,
                    'paid_leave_balance' => (int)$paidLeaveBalance,
                    
                    // Working days
                    'days_in_month' => (int)$daysInMonth,
                    'working_days' => (int)$workingDays,
                    'per_day_salary' => number_format($perDaySalary, 2, '.', ''),
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Payroll Employee Data Load Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error loading employee data: ' . $e->getMessage()
            ], 500);
        }
    }
}

