@extends('layouts.macos')
@section('page_title', 'Attendance Reports')

@section('content')
<div class="hrp-content">
  <!-- Filter Row -->
  <form method="GET" action="{{ route('attendance.report') }}" class="jv-filter">
    <input type="date" name="start_date" class="filter-pill" placeholder="From" value="{{ request('start_date') }}">
    <input type="date" name="end_date" class="filter-pill" placeholder="To" value="{{ request('end_date') }}">
    
    <select name="employee_id" class="filter-pill" style="min-width: 200px;">
      <option value="">All Employees</option>
      @foreach($employees as $emp)
        <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
          {{ $emp->name }}
        </option>
      @endforeach
    </select>

    <select name="status" class="filter-pill">
      <option value="">All Status</option>
      <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
      <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
      <option value="half_day" {{ request('status') == 'half_day' ? 'selected' : '' }}>Half Day</option>
      <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
    </select>

    <button type="submit" class="filter-search" aria-label="Search">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>
    
    <a href="{{ route('attendance.report') }}" class="filter-search" aria-label="Refresh">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
      </svg>
    </a>
    
    <div class="filter-right">
      <a href="{{ route('attendance.reports.export', request()->all()) }}" class="pill-btn pill-success">Export to Excel</a>
    </div>
  </form>

  <!-- Data Table -->
  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>EMP Code</th>
          <th>Employee</th>
          <th>Check IN & OUT</th>
          <th>Working Hours</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($attendances as $attendance)
        <tr>
          <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
          <td>{{ $attendance->employee->code ?? 'EMP-' . str_pad($attendance->employee->id ?? '000', 4, '0', STR_PAD_LEFT) }}</td>
          <td>{{ $attendance->employee->name ?? 'N/A' }}</td>
          <td>
            @if($attendance->check_in)
              <span style="color:#f97316;font-weight:600">{{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') }}</span>
            @else
              <span style="color:#9ca3af">--</span>
            @endif
            
            @if($attendance->check_in && $attendance->check_out)
              <span style="color:#6b7280"> — </span>
              @php
                $checkIn = \Carbon\Carbon::parse($attendance->check_in);
                $checkOut = \Carbon\Carbon::parse($attendance->check_out);
                $diff = $checkIn->diff($checkOut);
                $hours = $diff->h;
                $minutes = $diff->i;
              @endphp
              <span style="color:#6b7280">{{ $hours }}h {{ $minutes }}m</span>
              <span style="color:#6b7280"> — </span>
            @endif
            
            @if($attendance->check_out)
              <span style="color:#10b981;font-weight:600">{{ \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') }}</span>
            @else
              <span style="color:#9ca3af">--</span>
            @endif
          </td>
          <td>
            @if($attendance->total_working_hours)
              {{ $attendance->total_working_hours }}
            @elseif($attendance->check_in && $attendance->check_out)
              @php
                $mins = \Carbon\Carbon::parse($attendance->check_in)->diffInMinutes(\Carbon\Carbon::parse($attendance->check_out));
                $h = floor($mins / 60);
                $m = $mins % 60;
              @endphp
              {{ $h }}h {{ $m }}m
            @else
              <span style="color:#9ca3af">--</span>
            @endif
          </td>
          <td>
            @if($attendance->status == 'present')
              <span class="badge badge--success">Present</span>
            @elseif($attendance->status == 'absent')
              <span class="badge badge--danger">Absent</span>
            @elseif($attendance->status == 'half_day')
              <span class="badge badge--warning">Half Day</span>
            @elseif($attendance->status == 'late')
              <span class="badge badge--warning">Late</span>
            @else
              <span class="badge badge--secondary">{{ ucfirst($attendance->status ?? 'N/A') }}</span>
            @endif
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">
            <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24" style="margin-bottom: 12px; opacity: 0.5;">
              <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
            </svg>
            <p style="font-weight: 600; margin: 0;">No attendance records found</p>
            <p style="font-size: 14px; margin: 8px 0 0 0;">Try adjusting your filters</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($attendances->hasPages())
  <div style="margin-top: 20px; display: flex; justify-content: center;">
    {{ $attendances->links() }}
  </div>
  @endif
</div>
@endsection
