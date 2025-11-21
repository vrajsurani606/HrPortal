@extends('layouts.macos')
@section('page_title', 'Leave Management')

@section('content')
<div class="hrp-content">
  <!-- Filters -->
  <form method="GET" action="{{ route('leave-approval.index') }}" class="jv-filter">
    <input type="date" name="start_date" class="filter-pill" placeholder="From" value="{{ request('start_date') }}">
    <input type="date" name="end_date" class="filter-pill" placeholder="To" value="{{ request('end_date') }}">
    
    <select name="employee_id" class="filter-pill">
      <option value="">All Employee</option>
      @foreach(\App\Models\Employee::orderBy('name')->get() as $emp)
        <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
      @endforeach
    </select>
    
    <select name="status" class="filter-pill">
      <option value="">All Status</option>
      <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
      <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
      <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
    
    <button type="submit" class="filter-search" aria-label="Search">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>
    
    <a href="{{ route('leave-approval.index') }}" class="filter-search" aria-label="Refresh">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
      </svg>
    </a>

    <div class="filter-right">
      <button type="button" class="pill-btn pill-success" onclick="openAddLeaveModal()" style="display: flex; align-items: center; gap: 8px;">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
          <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
        Add Leave
      </button>
    </div>
  </form>

  <!-- Data Table -->
  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <style>
      .JV-datatble table td:first-child {
        text-align: center !important;
      }
      .JV-datatble table td:first-child > div {
        display: inline-flex !important;
        gap: 12px;
        align-items: center;
      }
      .leave-type {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
      }
      .leave-type--casual { background: #dbeafe; color: #1e40af; }
      .leave-type--medical { background: #fee2e2; color: #991b1b; }
      .leave-type--annual { background: #d1fae5; color: #065f46; }
    </style>
    <table>
      <thead>
        <tr>
          <th style="width: 140px; text-align: center;">Action</th>
          <th style="width: 130px;">EMP Code</th>
          <th style="width: 200px;">EMPLOYEE</th>
          <th style="width: 200px;">Start to End Date</th>
          <th style="width: 100px;">Duration</th>
          <th style="width: 120px;">Leave Type</th>
          <th>Leave Reason</th>
          <th style="width: 100px; text-align: center;">Status</th>
          <th style="width: 150px;">Applied Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($leaves as $leave)
        <tr>
          <td style="vertical-align: middle; padding: 14px;">
            <div>
              @if($leave->status == 'pending')
                <!-- Approve/Reject buttons for pending leaves -->
                <img src="{{ asset('action_icon/approve.svg') }}" alt="Approve" style="cursor: pointer; width: 20px; height: 20px;" onclick="approveLeave({{ $leave->id }})">
                <img src="{{ asset('action_icon/reject.svg') }}" alt="Reject" style="cursor: pointer; width: 20px; height: 20px;" onclick="rejectLeave({{ $leave->id }})">
              @else
                <!-- Edit/Delete buttons for approved/rejected leaves -->
                <img src="{{ asset('action_icon/edit.svg') }}" alt="Edit" style="cursor: pointer; width: 18px; height: 18px;" onclick="editLeave({{ $leave->id }})">
                <img src="{{ asset('action_icon/delete.svg') }}" alt="Delete" style="cursor: pointer; width: 18px; height: 18px;" onclick="deleteLeave({{ $leave->id }})">
              @endif
            </div>
          </td>
          <td style="vertical-align: middle; padding: 14px 16px;">{{ $leave->employee->code ?? 'N/A' }}</td>
          <td style="vertical-align: middle; padding: 14px 16px;">{{ $leave->employee->name ?? 'N/A' }}</td>
          <td style="vertical-align: middle; padding: 14px 16px;">
            {{ \Carbon\Carbon::parse($leave->start_date)->format('d M, Y') }} to {{ \Carbon\Carbon::parse($leave->end_date)->format('d M, Y') }}
          </td>
          <td style="vertical-align: middle; padding: 14px; text-align: center;">{{ $leave->total_days }} Day{{ $leave->total_days > 1 ? 's' : '' }}</td>
          <td style="vertical-align: middle; padding: 14px;">
            <span class="leave-type leave-type--{{ strtolower($leave->leave_type) }}">{{ ucfirst($leave->leave_type) }}</span>
          </td>
          <td style="vertical-align: middle; padding: 14px 16px;">{{ $leave->reason ?? '-' }}</td>
          <td style="vertical-align: middle; text-align: center; padding: 14px;">
            @php
              $statusColor = match($leave->status) {
                'approved' => '#10b981',
                'rejected' => '#ef4444',
                'pending' => '#f59e0b',
                default => '#6b7280',
              };
            @endphp
            <span style="color: {{ $statusColor }}; font-weight: 600; font-size: 14px;">{{ ucfirst($leave->status) }}</span>
          </td>
          <td style="vertical-align: middle; padding: 14px 16px;">{{ $leave->created_at->format('d M, Y, h:i A') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="9" style="text-align: center; padding: 40px; color: #9ca3af;">
            <p style="font-weight: 600; margin: 0;">No leave requests found</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($leaves->hasPages())
  <div style="margin-top: 20px; display: flex; justify-content: center;">
    {{ $leaves->links() }}
  </div>
  @endif
</div>

<!-- Add Leave Modal -->
<div id="addLeaveModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
  <div style="background: white; border-radius: 15px; padding: 30px; max-width: 500px; width: 90%; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
    <h3 style="margin: 0 0 20px 0; font-size: 22px; font-weight: 700;">Add Leave Request</h3>
    
    <form id="addLeaveForm" onsubmit="submitLeave(event)">
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Employee</label>
        <select name="employee_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
          <option value="">Select Employee</option>
          @foreach(\App\Models\Employee::orderBy('name')->get() as $emp)
            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
          @endforeach
        </select>
      </div>

      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Leave Type</label>
        <select name="leave_type" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
          <option value="">Select Type</option>
          <option value="casual">Casual</option>
          <option value="medical">Medical</option>
          <option value="annual">Annual</option>
        </select>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Start Date</label>
          <input type="date" name="start_date" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
        </div>
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">End Date</label>
          <input type="date" name="end_date" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
        </div>
      </div>

      <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Reason</label>
        <textarea name="reason" rows="3" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; resize: vertical;"></textarea>
      </div>

      <div style="display: flex; gap: 10px; justify-content: flex-end;">
        <button type="button" onclick="closeAddLeaveModal()" style="padding: 10px 20px; border: 1px solid #ddd; background: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Cancel</button>
        <button type="submit" style="padding: 10px 20px; border: none; background: #10b981; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Submit Leave</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Leave Modal -->
<div id="editLeaveModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
  <div style="background: white; border-radius: 15px; padding: 30px; max-width: 500px; width: 90%; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
    <h3 style="margin: 0 0 20px 0; font-size: 22px; font-weight: 700;">Edit Leave Request</h3>
    
    <form id="editLeaveForm" onsubmit="submitEditLeave(event)">
      <input type="hidden" name="leave_id" id="edit_leave_id">
      
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Employee</label>
        <select name="employee_id" id="edit_employee_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
          <option value="">Select Employee</option>
          @foreach(\App\Models\Employee::orderBy('name')->get() as $emp)
            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
          @endforeach
        </select>
      </div>

      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Leave Type</label>
        <select name="leave_type" id="edit_leave_type" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
          <option value="">Select Type</option>
          <option value="casual">Casual</option>
          <option value="medical">Medical</option>
          <option value="annual">Annual</option>
        </select>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Start Date</label>
          <input type="date" name="start_date" id="edit_start_date" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
        </div>
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">End Date</label>
          <input type="date" name="end_date" id="edit_end_date" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
        </div>
      </div>

      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Status</label>
        <select name="status" id="edit_status" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
          <option value="pending">Pending</option>
          <option value="approved">Approved</option>
          <option value="rejected">Rejected</option>
        </select>
      </div>

      <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Reason</label>
        <textarea name="reason" id="edit_reason" rows="3" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; resize: vertical;"></textarea>
      </div>

      <div style="display: flex; gap: 10px; justify-content: flex-end;">
        <button type="button" onclick="closeEditLeaveModal()" style="padding: 10px 20px; border: 1px solid #ddd; background: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Cancel</button>
        <button type="submit" style="padding: 10px 20px; border: none; background: #3b82f6; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Update Leave</button>
      </div>
    </form>
  </div>
</div>

<script>
// Wait for DOM and SweetAlert2 to be ready
document.addEventListener('DOMContentLoaded', function() {
  // Check if SweetAlert2 is loaded
  if (typeof Swal === 'undefined') {
    console.error('SweetAlert2 is not loaded!');
  }
});

function openAddLeaveModal() {
  document.getElementById('addLeaveModal').style.display = 'flex';
}

function closeAddLeaveModal() {
  document.getElementById('addLeaveModal').style.display = 'none';
  document.getElementById('addLeaveForm').reset();
}

function submitLeave(event) {
  event.preventDefault();
  const formData = new FormData(event.target);
  const data = Object.fromEntries(formData);
  
  // Calculate total days
  const start = new Date(data.start_date);
  const end = new Date(data.end_date);
  const diffTime = Math.abs(end - start);
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
  data.total_days = diffDays;
  
  fetch('{{ route("leave-approval.store") }}', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify(data)
  })
  .then(response => {
    if (!response.ok) {
      return response.json().then(err => {
        throw new Error(err.message || 'Server error');
      });
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      toastr.success('Leave request submitted successfully!');
      closeAddLeaveModal();
      setTimeout(() => location.reload(), 1000);
    } else {
      toastr.error('Error: ' + (data.message || 'Unknown error'));
    }
  })
  .catch(error => {
    toastr.error('Error submitting leave request: ' + error.message);
  });
}

function approveLeave(id) {
  if (typeof Swal === 'undefined') {
    if (confirm('Are you sure you want to approve this leave request?')) {
      updateLeaveStatus(id, 'approved');
    }
    return;
  }
  
  Swal.fire({
    title: 'Approve Leave?',
    text: 'Are you sure you want to approve this leave request?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#10b981',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, Approve',
    cancelButtonText: 'Cancel',
    width: '400px',
    padding: '1.5rem',
    customClass: { popup: 'perfect-swal-popup' }
  }).then((result) => {
    if (result.isConfirmed) {
      updateLeaveStatus(id, 'approved');
    }
  });
}

function rejectLeave(id) {
  if (typeof Swal === 'undefined') {
    if (confirm('Are you sure you want to reject this leave request?')) {
      updateLeaveStatus(id, 'rejected');
    }
    return;
  }
  
  Swal.fire({
    title: 'Reject Leave?',
    text: 'Are you sure you want to reject this leave request?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, Reject',
    cancelButtonText: 'Cancel',
    width: '400px',
    padding: '1.5rem',
    customClass: { popup: 'perfect-swal-popup' }
  }).then((result) => {
    if (result.isConfirmed) {
      updateLeaveStatus(id, 'rejected');
    }
  });
}

function updateLeaveStatus(id, status) {
  const formData = new FormData();
  formData.append('_method', 'PUT');
  formData.append('status', status);
  
  fetch(`{{ url('leave-approval') }}/${id}`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      toastr.success(data.message);
      setTimeout(() => location.reload(), 1000);
    } else {
      toastr.error('Error: ' + (data.message || 'Unknown error'));
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toastr.error('Error updating leave status');
  });
}

function editLeave(id) {
  // Fetch leave data
  fetch(`{{ url('leave-approval') }}/${id}/edit`, {
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const leave = data.leave;
      
      // Format dates for input fields (YYYY-MM-DD)
      const formatDate = (dateStr) => {
        if (!dateStr) return '';
        const date = new Date(dateStr);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
      };
      
      document.getElementById('edit_leave_id').value = leave.id;
      document.getElementById('edit_employee_id').value = leave.employee_id;
      document.getElementById('edit_leave_type').value = leave.leave_type;
      document.getElementById('edit_start_date').value = formatDate(leave.start_date);
      document.getElementById('edit_end_date').value = formatDate(leave.end_date);
      document.getElementById('edit_status').value = leave.status;
      document.getElementById('edit_reason').value = leave.reason || '';
      document.getElementById('editLeaveModal').style.display = 'flex';
    } else {
      toastr.error('Error loading leave data');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toastr.error('Error loading leave data');
  });
}

function closeEditLeaveModal() {
  document.getElementById('editLeaveModal').style.display = 'none';
  document.getElementById('editLeaveForm').reset();
}

function submitEditLeave(event) {
  event.preventDefault();
  const formData = new FormData(event.target);
  const data = Object.fromEntries(formData);
  const leaveId = data.leave_id;
  
  // Calculate total days
  const start = new Date(data.start_date);
  const end = new Date(data.end_date);
  const diffTime = Math.abs(end - start);
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
  data.total_days = diffDays;
  
  const formDataToSend = new FormData();
  formDataToSend.append('_method', 'PUT');
  formDataToSend.append('employee_id', data.employee_id);
  formDataToSend.append('leave_type', data.leave_type);
  formDataToSend.append('start_date', data.start_date);
  formDataToSend.append('end_date', data.end_date);
  formDataToSend.append('status', data.status);
  formDataToSend.append('reason', data.reason);
  formDataToSend.append('total_days', data.total_days);
  
  fetch(`{{ url('leave-approval') }}/${leaveId}`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: formDataToSend
  })
  .then(response => {
    if (!response.ok) {
      return response.json().then(err => {
        throw new Error(err.message || 'Server error');
      });
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      toastr.success('Leave request updated successfully!');
      closeEditLeaveModal();
      setTimeout(() => location.reload(), 1000);
    } else {
      toastr.error('Error: ' + (data.message || 'Unknown error'));
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toastr.error('Error updating leave request: ' + error.message);
  });
}

function deleteLeave(id) {
  if (typeof Swal === 'undefined') {
    if (confirm('Are you sure you want to delete this leave request? This action cannot be undone.')) {
      performDelete(id);
    }
    return;
  }
  
  Swal.fire({
    title: 'Delete Leave?',
    text: 'Are you sure you want to delete this leave request? This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, Delete',
    cancelButtonText: 'Cancel',
    width: '400px',
    padding: '1.5rem',
    customClass: { popup: 'perfect-swal-popup' }
  }).then((result) => {
    if (result.isConfirmed) {
      performDelete(id);
    }
  });
}

function performDelete(id) {
  const formData = new FormData();
  formData.append('_method', 'DELETE');
  
  fetch(`{{ url('leave-approval') }}/${id}`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      toastr.success('Leave request deleted successfully!');
      setTimeout(() => location.reload(), 1000);
    } else {
      toastr.error('Error deleting leave request');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toastr.error('Error deleting leave request');
  });
}
</script>
@endsection
