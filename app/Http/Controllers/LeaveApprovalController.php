<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveApprovalController extends Controller
{
    /**
     * Display a listing of leave requests for approval.
     */
    public function index(Request $request)
    {
        $query = Leave::with(['employee.user']);

        // Filter by status - show all if no status filter is applied
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('start_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('end_date', '<=', $request->end_date);
        }

        // Filter by employee
        if ($request->has('employee_id') && $request->employee_id) {
            $query->where('employee_id', $request->employee_id);
        }

        // Order by created date descending
        $leaves = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('hr.attendance.leave-approval', compact('leaves'));
    }

    /**
     * Store a new leave request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
            'total_days' => 'required|integer|min:1'
        ]);

        $leave = Leave::create([
            'employee_id' => $request->employee_id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $request->total_days,
            'reason' => $request->reason,
            'status' => 'pending'
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Leave request submitted successfully!',
                'leave' => $leave
            ]);
        }

        return redirect()->back()->with('success', 'Leave request submitted successfully!');
    }

    /**
     * Show the form for editing the specified leave request.
     */
    public function edit($leave_approval)
    {
        $leave = Leave::findOrFail($leave_approval);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'leave' => $leave
            ]);
        }

        return view('hr.attendance.leave-edit', compact('leave'));
    }

    /**
     * Update the specified leave request.
     */
    public function update(Request $request, $leave_approval)
    {
        // Check if this is a simple status update (approve/reject) or full edit
        if ($request->has('employee_id')) {
            // Full edit
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'leave_type' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'reason' => 'required|string|max:500',
                'total_days' => 'required|integer|min:1',
                'status' => 'required|in:pending,approved,rejected'
            ]);

            $leave = Leave::findOrFail($leave_approval);
            
            $leave->employee_id = $request->employee_id;
            $leave->leave_type = $request->leave_type;
            $leave->start_date = $request->start_date;
            $leave->end_date = $request->end_date;
            $leave->total_days = $request->total_days;
            $leave->reason = $request->reason;
            $leave->status = $request->status;
            
            if ($request->status !== 'pending' && !$leave->approved_by) {
                $leave->approved_by = auth()->id();
                $leave->approved_at = now();
            }
            
            $leave->save();

            $message = 'Leave request updated successfully!';
        } else {
            // Simple status update (approve/reject)
            $request->validate([
                'status' => 'required|in:approved,rejected',
                'remarks' => 'nullable|string|max:500'
            ]);

            $leave = Leave::findOrFail($leave_approval);
            
            $leave->status = $request->status;
            $leave->approved_by = auth()->id();
            $leave->approved_at = now();
            
            if ($request->remarks) {
                $leave->remarks = $request->remarks;
            }
            
            $leave->save();

            $message = $request->status === 'approved' 
                ? 'Leave request approved successfully!' 
                : 'Leave request rejected.';
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'leave' => $leave
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the specified leave request.
     */
    public function destroy($leave_approval)
    {
        $leave = Leave::findOrFail($leave_approval);
        $leave->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Leave request deleted successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Leave request deleted successfully!');
    }
}
