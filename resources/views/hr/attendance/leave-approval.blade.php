@extends('layouts.macos')
@section('page_title', 'Leave Management')

@section('content')
<div class="hrp-content">
  <!-- Filters: Date Range, Employee, Status -->
  <div class="jv-filter">
    <select class="filter-pill" required>
      <option value="" disabled selected>Select Date Range</option>
      <option value="last_7">Last 7 days</option>
      <option value="last_30">Last 30 days</option>
      <option value="custom">Custom Range</option>
    </select>
    <select class="filter-pill" required>
      <option value="" disabled selected>All Employee</option>
      <option value="active">Active</option>
      <option value="inactive">Inactive</option>
    </select>
    <select class="filter-pill" required>
      <option value="" disabled selected>All Status</option>
      <option value="approved">Approved</option>
      <option value="pending">Pending</option>
      <option value="rejected">Rejected</option>
    </select>
    <button type="button" class="filter-search" aria-label="Search">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>
    <button type="button" class="filter-search" aria-label="Refresh">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
      </svg>
    </button>
  </div>

  <!-- JV Data Table -->
  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <table>
      <thead>
        <tr>
          <th>Action</th>
          <th>EMP Code</th>
          <th>EMPLOYEE</th>
          <th>Start to End Date</th>
          <th>Duration</th>
          <th>Leave Type</th>
          <th>Leave Reason</th>
          <th>Status</th>
          <th>Applied Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="action-icons">
              <img src="{{ asset('action_icon/completed.svg') }}" class="action-icon" alt="Approve">
              <img src="{{ asset('action_icon/delete.svg') }}" class="action-icon" alt="Reject">
            </div>
          </td>
          <td>CHITRI_0024</td>
          <td>Patel Ravi Raghavbhai</td>
          <td>30 Jul, 2025 to 31 Jul, 2025</td>
          <td>01 Day</td>
          <td><span class="leave-type leave-type--casual">Casual</span></td>
          <td>Marriage Function</td>
          <td>
            <img src="{{ asset('action_icon/pending.svg') }}" class="action-icon" alt="Pending">
          </td>
          <td>30 Jul, 2025, 10:19 AM</td>
          <td><img src="{{ asset('action_icon/rightclick.svg') }}" class="action-icon" alt="More"></td>
        </tr>
        <tr>
          <td>
            <div class="action-icons">
              <img src="{{ asset('action_icon/completed.svg') }}" class="action-icon" alt="Approve">
              <img src="{{ asset('action_icon/delete.svg') }}" class="action-icon" alt="Reject">
            </div>
          </td>
          <td>CHITRI_0025</td>
          <td>Savaliya Jayesh Mansukhbhai</td>
          <td>25 Jul, 2025 to 27 Jul, 2025</td>
          <td>02 Day</td>
          <td><span class="leave-type leave-type--medical">Medical</span></td>
          <td>Marriage Function</td>
          <td>
            <img src="{{ asset('action_icon/completed.svg') }}" class="action-icon" alt="Approved">
          </td>
          <td>27 Jul, 2025, 12:29 PM</td>
          <td><img src="{{ asset('action_icon/rightclick.svg') }}" class="action-icon" alt="More"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
