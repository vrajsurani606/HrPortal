@extends('layouts.macos')
@section('page_title', 'Attendance Reports')

@section('content')
<div class="hrp-content">
  <!-- Filter Row (Payroll-style) -->
  <div class="jv-filter">
    <input type="date" class="filter-pill" placeholder="From : dd/mm/yyyy">
    <input type="date" class="filter-pill" placeholder="To : dd/mm/yyyy">
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
    
    <div class="filter-right">
      <a href="#" class="pill-btn pill-success">Export to Excel</a>
    </div>
  </div>

  <!-- JV Data Table -->
  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <table>
      <thead>
        <tr>
          <th>Action</th>
          <th>EMP Code</th>
          <th>EMPLOYEE</th>
          <th>Check IN & OUT</th>
          <th>Overtime</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="action-icons">
              <img class="action-icon" src="{{ asset('action_icon/edit.svg') }}" alt="Edit">
              <img class="action-icon" src="{{ asset('action_icon/delete.svg') }}" alt="Delete">
              <img class="action-icon" src="{{ asset('action_icon/print.svg') }}" alt="Print">
            </div>
          </td>
          <td>CHITRI_0024</td>
          <td>Patel Ravi Raghavbhai</td>
          <td>
            <span style="color:#f97316;font-weight:600">09:36 AM</span> — <span style="color:#6b7280">08h 49m</span> — <span style="color:#ef4444;font-weight:600">06:25 PM</span>
          </td>
          <td>0h 19m</td>
          <td>
            <span class="badge badge--success">Present</span>
          </td>
          <td>
            <button style="background:none;border:none;cursor:pointer;padding:4px">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="#6b7280">
                <path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z"/>
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="action-icons">
              <img class="action-icon" src="{{ asset('action_icon/edit.svg') }}" alt="Edit">
              <img class="action-icon" src="{{ asset('action_icon/delete.svg') }}" alt="Delete">
              <img class="action-icon" src="{{ asset('action_icon/print.svg') }}" alt="Print">
            </div>
          </td>
          <td>CHITRI_0025</td>
          <td>Savaliya Jayesh Mansukhbhai</td>
          <td>
            <span style="color:#f97316;font-weight:600">09:40 AM</span> — <span style="color:#6b7280">08h 35m</span> — <span style="color:#ef4444;font-weight:600">06:15 PM</span>
          </td>
          <td>--</td>
          <td>
            <span class="badge badge--warning">Half Day</span>
          </td>
          <td>
            <button style="background:none;border:none;cursor:pointer;padding:4px">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="#6b7280">
                <path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z"/>
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="action-icons">
              <img class="action-icon" src="{{ asset('action_icon/edit.svg') }}" alt="Edit">
              <img class="action-icon" src="{{ asset('action_icon/delete.svg') }}" alt="Delete">
              <img class="action-icon" src="{{ asset('action_icon/print.svg') }}" alt="Print">
            </div>
          </td>
          <td>CHITRI_0017</td>
          <td>Panchal Swara Piyushbhai</td>
          <td>
            <span style="color:#f97316;font-weight:600">09:55 AM</span> — <span style="color:#6b7280">08h 45m</span> — <span style="color:#10b981;font-weight:600">06:40 PM</span>
          </td>
          <td>0h 15m</td>
          <td>
            <span class="badge badge--success">Present</span>
          </td>
          <td>
            <button style="background:none;border:none;cursor:pointer;padding:4px">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="#6b7280">
                <path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z"/>
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="action-icons">
              <img class="action-icon" src="{{ asset('action_icon/edit.svg') }}" alt="Edit">
              <img class="action-icon" src="{{ asset('action_icon/delete.svg') }}" alt="Delete">
              <img class="action-icon" src="{{ asset('action_icon/print.svg') }}" alt="Print">
            </div>
          </td>
          <td>CHITRI_0032</td>
          <td>Vasani Chirag Mukeshbhai</td>
          <td>
            <span style="color:#10b981;font-weight:600">09:17 AM</span> — <span style="color:#6b7280">10h 03m</span> — <span style="color:#10b981;font-weight:600">07:20 PM</span>
          </td>
          <td>1h 33m</td>
          <td>
            <span class="badge badge--success">Present</span>
          </td>
          <td>
            <button style="background:none;border:none;cursor:pointer;padding:4px">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="#6b7280">
                <path d="M12,16A2,2 0 0,1 14,18A2,2 0 0,1 12,20A2,2 0 0,1 10,18A2,2 0 0,1 12,16M12,10A2,2 0 0,1 14,12A2,2 0 0,1 12,14A2,2 0 0,1 10,12A2,2 0 0,1 12,10M12,4A2,2 0 0,1 14,6A2,2 0 0,1 12,8A2,2 0 0,1 10,6A2,2 0 0,1 12,4Z"/>
              </svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection

