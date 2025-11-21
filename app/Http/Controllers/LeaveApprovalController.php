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

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        } else {
            // Default: show pending leaves
            $query->where('status', 'pending');
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
     * Update the specified leave request (approve/reject).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'remarks' => 'nullable|string|max:500'
        ]);

        $leave = Leave::findOrFail($id);
        
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

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'leave' => $leave
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
