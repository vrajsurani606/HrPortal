<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    /**
     * Display a listing of leaves
     */
    public function index()
    {
        $user = Auth::user();
        
        // If admin/HR, show all leaves. Otherwise, show only user's leaves
        if ($user->hasRole(['admin', 'hr'])) {
            $leaves = Leave::with('employee')->orderBy('created_at', 'desc')->paginate(20);
        } else {
            $employee = Employee::where('user_id', $user->id)->first();
            if (!$employee) {
                return redirect()->back()->with('error', 'Employee profile not found.');
            }
            $leaves = Leave::where('employee_id', $employee->id)->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('leaves.index', compact('leaves'));
    }

    /**
     * Store a newly created leave
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validate request
        $validated = $request->validate([
            'leave_type' => 'required|in:casual,medical,personal,company_holiday',
            'is_paid' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_days' => 'required|numeric|min:0.5',
            'reason' => 'required|string|max:500',
            'employee_id' => 'nullable|exists:employees,id'
        ]);

        // Determine employee_id
        if ($user->hasRole(['admin', 'hr']) && $request->has('employee_id')) {
            $employeeId = $request->employee_id;
        } else {
            $employee = Employee::where('user_id', $user->id)->first();
            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee profile not found'
                ], 404);
            }
            $employeeId = $employee->id;
        }

        // Create leave
        $leave = Leave::create([
            'employee_id' => $employeeId,
            'leave_type' => $validated['leave_type'],
            'is_paid' => $validated['is_paid'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_days' => (float) $validated['total_days'], // Cast to float to preserve decimals
            'reason' => $validated['reason'],
            'status' => 'pending'
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Leave request submitted successfully!',
                'leave' => $leave
            ]);
        }

        return redirect()->route('leaves.index')->with('success', 'Leave request submitted successfully!');
    }

    /**
     * Display the specified leave
     */
    public function show(Leave $leave)
    {
        return view('leaves.show', compact('leave'));
    }

    /**
     * Update the specified leave
     */
    public function update(Request $request, Leave $leave)
    {
        $validated = $request->validate([
            'leave_type' => 'required|in:casual,medical,personal,company_holiday',
            'is_paid' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_days' => 'required|numeric|min:0.5',
            'reason' => 'required|string|max:500',
            'status' => 'nullable|in:pending,approved,rejected'
        ]);

        $leave->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Leave updated successfully!',
                'leave' => $leave
            ]);
        }

        return redirect()->route('leaves.index')->with('success', 'Leave updated successfully!');
    }

    /**
     * Remove the specified leave
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Leave deleted successfully!'
            ]);
        }

        return redirect()->route('leaves.index')->with('success', 'Leave deleted successfully!');
    }

    /**
     * Get paid leave balance for an employee
     */
    public function getPaidLeaveBalance($employeeId)
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        
        // Get yearly paid leave count
        $yearlyUsed = Leave::where('employee_id', $employeeId)
            ->where('is_paid', true)
            ->whereYear('start_date', $currentYear)
            ->where('status', '!=', 'rejected')
            ->sum('total_days');
        
        // Get current month paid leave count
        $monthUsed = Leave::where('employee_id', $employeeId)
            ->where('is_paid', true)
            ->whereYear('start_date', $currentYear)
            ->whereMonth('start_date', $currentMonth)
            ->where('status', '!=', 'rejected')
            ->sum('total_days');
        
        return response()->json([
            'success' => true,
            'yearly_used' => $yearlyUsed,
            'yearly_total' => 12,
            'yearly_available' => 12 - $yearlyUsed,
            'month_used' => $monthUsed,
            'month_total' => 1,
            'month_available' => 1 - $monthUsed
        ]);
    }

    /**
     * Approve a leave
     */
    public function approve(Request $request, Leave $leave)
    {
        $leave->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now()
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Leave approved successfully!',
                'leave' => $leave
            ]);
        }

        return redirect()->back()->with('success', 'Leave approved successfully!');
    }

    /**
     * Reject a leave
     */
    public function reject(Request $request, Leave $leave)
    {
        $leave->update([
            'status' => 'rejected',
            'rejected_by' => Auth::id(),
            'rejected_at' => now()
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Leave rejected successfully!',
                'leave' => $leave
            ]);
        }

        return redirect()->back()->with('success', 'Leave rejected successfully!');
    }
}
