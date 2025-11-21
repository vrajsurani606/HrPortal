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
        $employeeId = $request->employee_id;
        $month = $request->month ?? date('F');
        $year = $request->year ?? date('Y');

        $employee = Employee::findOrFail($employeeId);
        
        // Get employee's basic salary from current_offer_amount field
        $basicSalary = $employee->current_offer_amount ?? $employee->salary ?? 0;
        
        // Calculate working days in month
        $monthNumber = date('n', strtotime($month));
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $year);
        
        // Get leave days for this employee in this month
        $leaveDays = \App\Models\Leave::where('employee_id', $employeeId)
            ->where('status', 'approved')
            ->whereYear('start_date', $year)
            ->whereMonth('start_date', $monthNumber)
            ->sum('total_days');
        
        // Calculate per day salary based on current_offer_amount
        $perDaySalary = $basicSalary / $daysInMonth;
        
        // Calculate leave deduction
        $leaveDeduction = $perDaySalary * $leaveDays;
        
        // Calculate working days
        $workingDays = $daysInMonth - $leaveDays;
        
        // Allowances - fetch from employee incentive_amount
        $allowances = $employee->incentive_amount ?? 0;
        
        // Bonuses - set to 0 by default (can be entered manually)
        $bonuses = 0;
        
        // Tax - set to 0 by default (can be entered manually)
        $grossSalary = $basicSalary + $allowances + $bonuses;
        $tax = 0;
        
        // Total deductions
        $totalDeductions = $leaveDeduction;
        
        // Net salary
        $netSalary = ($basicSalary + $allowances + $bonuses) - ($totalDeductions + $tax);
        
        return response()->json([
            'success' => true,
            'data' => [
                'employee_name' => $employee->name,
                'employee_code' => $employee->code,
                'basic_salary' => number_format($basicSalary, 2, '.', ''),
                'allowances' => number_format($allowances, 2, '.', ''),
                'bonuses' => number_format($bonuses, 2, '.', ''),
                'leave_days' => $leaveDays,
                'leave_deduction' => number_format($leaveDeduction, 2, '.', ''),
                'deductions' => number_format($totalDeductions, 2, '.', ''),
                'tax' => number_format($tax, 2, '.', ''),
                'net_salary' => number_format($netSalary, 2, '.', ''),
                'days_in_month' => $daysInMonth,
                'working_days' => $workingDays,
                'per_day_salary' => number_format($perDaySalary, 2, '.', ''),
            ]
        ]);
    }
}

