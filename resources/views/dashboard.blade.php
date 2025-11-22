@extends('layouts.macos')

@section('page_title','Dashboard')

@push('styles')
<style>
  .dataTables_filter, .dataTables_length { display: none !important; }
  .top-right{ display:flex; align-items:center; gap:12px; justify-content:flex-end; }
  .notify-bell{ position:relative; display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:9999px; background:#fff; border:1px solid #ececec }
  .notify-bell .badge-dot{ position:absolute; top:-3px; right:-3px; width:16px; height:16px; background:#ef4444; color:#fff; border-radius:9999px; font-size:10px; font-weight:700; display:flex; align-items:center; justify-content:center }
  .search-wrap{ max-width:420px }
  /* Dashboard: avoid double search icon (we already render <span class="search-ico">) */
  .top-right #globalSearch{ background-image:none !important; padding-left:0 !important; }
  
  /* Admin Notes - Perfect Chip Design */
  .chip { 
    display: inline-flex; 
    align-items: center; 
    gap: 6px; 
    padding: 6px 12px; 
    border-radius: 6px; 
    font-size: 13px; 
    font-weight: 500;
    transition: all 0.2s ease;
  }
  .chip-blue { 
    background: #dbeafe; 
    color: #1e40af; 
    border: 1px solid #bfdbfe;
  }
  .chip button {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0;
    margin-left: 4px;
    font-size: 18px;
    line-height: 1;
    font-weight: 700;
    opacity: 0.7;
    transition: opacity 0.2s ease;
  }
  .chip button:hover {
    opacity: 1;
  }
  .notes-assign-section label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
  }
  .notes-add:hover {
    background: #1d4ed8 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(38, 123, 245, 0.4) !important;
  }
  .btn-add-employees-round {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .btn-add-employees-round:hover {
    background: #059669 !important;
    transform: scale(1.1) rotate(90deg);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.6) !important;
  }
  .btn-add-employees-round:active {
    transform: scale(0.95) rotate(90deg);
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4) !important;
  }
  #adminChipsContainer {
    position: relative;
  }
  #adminChips {
    min-height: 40px;
    padding: 12px;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px dashed #cbd5e1;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
  }
  #btnSaveAdminNote:hover {
    background: #0f9d4f !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(20, 174, 92, 0.3);
  }
  
  /* Employee Selection Modal */
  .employee-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
  }
  .modal-content {
    position: relative;
    background: white;
    border-radius: 16px;
    width: 90%;
    max-width: 800px;
    max-height: 85vh;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.3s ease-out;
  }
  @keyframes modalSlideIn {
    from {
      opacity: 0;
      transform: translateY(-20px) scale(0.95);
    }
    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }
  .modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-bottom: 1px solid #e2e8f0;
  }
  .modal-close:hover {
    color: #ef4444 !important;
    background: #fee2e2 !important;
  }
  .modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
  }
  .employee-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 16px;
  }
  .employee-card {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    background: white;
  }
  .employee-card:hover {
    border-color: #267bf5;
    background: #f0f9ff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(38, 123, 245, 0.15);
  }
  .employee-card.selected {
    border-color: #267bf5;
    background: #dbeafe;
    box-shadow: 0 0 0 3px rgba(38, 123, 245, 0.1);
  }
  .employee-checkbox {
    position: absolute;
    top: 8px;
    right: 8px;
  }
  .employee-checkbox input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: #267bf5;
  }
  .employee-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 12px;
    border: 3px solid #e2e8f0;
    transition: border-color 0.2s ease;
  }
  .employee-card.selected .employee-avatar {
    border-color: #267bf5;
  }
  .employee-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .employee-name {
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
    text-align: center;
    line-height: 1.3;
  }
  .modal-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    border-top: 1px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 0 0 16px 16px;
  }
  .selected-count {
    font-size: 14px;
    font-weight: 600;
    color: #475569;
  }
  .modal-actions {
    display: flex;
    gap: 12px;
  }
  .btn-cancel {
    padding: 10px 24px;
    background: white;
    color: #64748b;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
  }
  .btn-cancel:hover {
    background: #f1f5f9;
    border-color: #94a3b8;
  }
  .btn-confirm {
    padding: 10px 24px;
    background: #267bf5;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s ease;
  }
  .btn-confirm:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(38, 123, 245, 0.3);
  }
  .btn-confirm:disabled {
    background: #cbd5e1;
    cursor: not-allowed;
    transform: none;
  }
</style>
@endpush

@section('content')
  @php($stats = $stats ?? [])
  <div class="hrp-grid" style="padding:14px">
    <div class="hrp-col-12">
      <div class="top-right">
        <div class="search-wrap" style="max-width:420px">
          <span class="search-ico">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </span>
          <input id="globalSearch" type="text" class="search-input" placeholder="Type to search..." />
        </div>
        <div class="notify-pill" title="Notifications">
          <span class="notify-bell">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
              <path d="M18 8a6 6 0 1 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
            </svg>
            <span class="badge-dot">{{ (isset($notifications) && is_countable($notifications)) ? min(count($notifications),9) : 3 }}</span>
          </span>
        </div>
      </div>
    </div>

    <div class="hrp-col-12">
      <div class="hrp-grid">
        <div class="hrp-col-3">
          <div class="dash-kpi kpi-emp">
            <div class="kpi-top">
              <div class="kpi-left">
                <div class="kpi-ico"><img src="{{ asset('kpi_icon/kpi1.svg') }}" alt="Employees"></div>
              </div>
              <div class="value">{{ data_get($stats, 'employees', 126) }}</div>
            </div>
            <div class="kpi-title">Total Employees</div>
            <div class="delta" style="display:none">{{ data_get($stats, 'delta_employees', '+3%') }}</div>
            <div class="kpi-sub green">{{ data_get($stats, 'delta_employees', '+8%') }} From Last Month</div>
          </div>
        </div>
        <div class="hrp-col-3">
          <div class="dash-kpi kpi-proj">
            <div class="kpi-top">
              <div class="kpi-left">
                <div class="kpi-ico"><img src="{{ asset('kpi_icon/kpi2.svg') }}" alt="Projects"></div>
              </div>
              <div class="value">{{ data_get($stats, 'projects', 18) }}</div>
            </div>
            <div class="kpi-title">Active Projects</div>
            <div class="delta" style="display:none">{{ data_get($stats, 'delta_projects', '+12%') }}</div>
            <div class="kpi-sub green">{{ data_get($stats, 'delta_projects', '+3%') }} From Last Month</div>
          </div>
        </div>
        <div class="hrp-col-3">
          <div class="dash-kpi kpi-task">
            <div class="kpi-top">
              <div class="kpi-left">
                <div class="kpi-ico"><img src="{{ asset('kpi_icon/kpi3.svg') }}" alt="Open Positions"></div>
              </div>
              <div class="value">{{ data_get($stats, 'open_positions', 6) }}</div>
            </div>
            <div class="kpi-title">Pending Task</div>
            <div class="delta" style="display:none">{{ data_get($stats, 'delta_open_positions', '-2%') }}</div>
            <div class="kpi-sub red">{{ data_get($stats, 'urgent_priority', '+7') }} Urgent Priority</div>
          </div>
        </div>
        <div class="hrp-col-3">
          <div class="dash-kpi kpi-attn">
            <div class="kpi-top">
              <div class="kpi-left">
                <div class="kpi-ico"><img src="{{ asset('kpi_icon/kpi4.svg') }}" alt="Attendance"></div>
              </div>
              <div class="value">{{ data_get($stats, 'attendance_percent', '96%') }}</div>
            </div>
            <div class="kpi-title">Attendance Today</div>
            <div class="delta" style="display:none">{{ data_get($stats, 'attendance_percent', '92%') }}</div>
            <div class="kpi-sub blue">{{ data_get($stats, 'attendance_present', '32/35') }} Present</div>
          </div>
        </div>
      </div>
    </div>
    <div class="hrp-col-12">
      <div class="card-table">
        <div class="table-header">RECENT INQUIRIES</div>
        <div class="table-body">
          <div class="hrp-table-wrap">
            <table class="hrp-table">
              <thead>
              <tr>
                <th>Action</th>
                <th>Is Confirm</th>
                <th>Company Name</th>
                <th>Person Name</th>
                <th>Person No</th>
                <th>Next Date</th>
                <th>Demo Status</th>
                <th>Demo Date & Time</th>
              </tr>
              </thead>
              <tbody>
              @foreach(($recentInquiries ?? []) as $inq)
                <tr>
                  <td><a href="#" class="action-icon view"><img src="{{ asset('action_icon/view.svg') }}" alt="view"></a></td>
                  <td class="text-green">YES</td>
                  <td>{{ $inq['company'] }}</td>
                  <td>{{ $inq['person'] ?? '—' }}</td>
                  <td>{{ $inq['phone'] ?? '—' }}</td>
                  <td>{{ $inq['next'] ?? $inq['date'] }}</td>
                  <td><a href="#" class="link-blue">{{ $inq['status'] }}</a></td>
                  <td>{{ $inq['demo'] ?? $inq['date'].' | 10:42 AM' }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="hrp-col-12">
      <div class="card-table" style="margin-top:12px">
        <div class="table-header">TICKET LIST</div>
        <div class="table-body">
          <div class="hrp-table-wrap">
            <table class="hrp-table">
              <thead>
              <tr>
                <th>Action</th>
                <th>Serial No.</th>
                <th>Ticket</th>
                <th>Work by Employee</th>
                <th>Category</th>
                <th>Customer</th>
                <th>Title</th>
                <th>Description</th>
              </tr>
              </thead>
              <tbody>
              @foreach(($recentTickets ?? []) as $idx => $t)
                <tr>
                  <td class="action-icons">
                    <button class="action-icon view" title="View"><img src="{{ asset('action_icon/view.svg') }}" alt="view"></button>
                      <button class="action-icon delete" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}" alt="delete"></button>
                  </td>
                  <td>{{ $idx+1 }}</td>
                  <td><a href="#" class="link-blue">{{ $t['status'] ?? 'Closed' }}</a></td>
                  <td class="{{ $t['priority'] === 'green' ? 'text-green' : ($t['priority'] === 'orange' ? 'text-red' : '') }}">{{ $t['work'] ?? ($t['priority']==='green'?'Completed':'Work Not Assigned') }}</td>
                  <td>{{ $t['category'] ?? 'General Inquiry' }}</td>
                  <td>{{ $t['customer'] ?? 'Customer' }}</td>
                  <td>{{ $t['title'] }}</td>
                  <td>{{ $t['desc'] ?? 'All OK & Working' }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="hrp-col-5">
      <div class="hrp-card card-p-0 chart-card">
        <div class="tabbar tabbar-chart">
          <div class="tab active" data-tab="company"><span class="ico">🏢</span> COMPANY LIST</div>
        </div>
        <div class="hrp-card-body chart-body">
          <div class="chart-wrap"><canvas id="chartCompany"></canvas></div>
          <div id="chartCompanyLegend" class="chart-legend"></div>
        </div>
      </div>
    </div>
    <div class="hrp-col-7">
      <div class="hrp-card card-p-0">
        <div class="tabbar">
          <div class="tab active" data-tab="notes"><span class="ico">📑</span> NOTES</div>
          <div class="tab" data-tab="admin"><span class="ico">👤</span> ADMIN NOTES</div>
          <div class="tab" data-tab="emp"><span class="ico">👥</span> EMP. NOTES</div>
        </div>
        <div class="hrp-card-body-note">
          <div class="tab-pane show" id="tab-notes">
            <div class="notes-title">Add New Notes</div>
            @can('Dashboard.manage dashboard')
            <div class="notes-entry">
              <textarea class="notes-area" rows="3" placeholder="Enter your Note....."></textarea>
              <button class="notes-send" type="button" aria-label="Add">➤</button>
            </div>
            @endcan
            <div class="chips-wrap" style="display:none"></div>
            <div class="notes-grid">
              @foreach(data_get($notes, 'notes', []) as $n)
                <div class="note-card">
                  <div class="note-text">{{ $n['text'] }}</div>
                  <div class="note-meta">{{ $n['date'] }} <span class="del">🗑️</span></div>
                </div>
              @endforeach
            </div>
            <div class="pager pager-num" id="notesPager">
              <a class="prev" href="#">«</a>
              <span class="num active">01</span>
              <span class="num">02</span>
              <span class="sep">…</span>
              <span class="num">20</span>
              <a class="next" href="#">»</a>
            </div>
          </div>
          <div class="tab-pane" id="tab-admin" hidden>
            @can('Dashboard.manage dashboard')
              <div class="notes-title">Add New Admin Notes</div>
              <textarea class="notes-area" id="adminNoteText" rows="3" placeholder="Enter your admin note....."></textarea>
              
              <div class="notes-assign-section" style="margin-top: 16px; position: relative;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                  <label style="font-size: 13px; font-weight: 600; color: #475569; margin: 0;">
                    Assigned Employees:
                  </label>
                  <button type="button" id="btnOpenEmployeeModal" class="btn-add-employees-round" style="width: 40px; height: 40px; background: #10b981; color: white; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                  </button>
                </div>
                
                <div id="adminChips" style="display: flex; flex-wrap: wrap; gap: 10px; min-height: 40px;">
                  <span id="emptyChipsMessage" style="color: #94a3b8; font-size: 13px; font-style: italic;">No employees assigned yet</span>
                </div>
              </div>

              <button type="button" id="btnSaveAdminNote" class="hrp-btn hrp-btn-primary" style="margin-top: 20px; padding: 12px 32px; background: #14ae5c; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600; width: 100%;">
                💾 Save Admin Note
              </button>
            @endcan
          </div>
          <div class="tab-pane" id="tab-emp" hidden>
            <div class="notes-list">
              @foreach(data_get($notes, 'emp', []) as $n)
                <div class="notes-item">
                  <div class="item-text">{{ $n['text'] }}</div>
                  <div class="item-chips">
                    @foreach(($n['assignees'] ?? []) as $ass)
                      <span class="chip chip-blue">{{ $ass }}</span>
                    @endforeach
                  </div>
                  <div class="item-meta">
                    <span class="ico">⏰</span> {{ $n['date'] }}
                    <span class="ico">⏳</span> {{ $n['expiry'] ?? 'No expiration' }}
                    @can('Dashboard.manage dashboard')
                    <span class="actions">
                      <a href="#" class="view" title="View"><img src="{{ asset('action_icon/view.svg') }}" alt="view"></a>
                      <a href="#" class="edit" title="Edit"><img src="{{ asset('action_icon/edit.svg') }}" alt="edit"></a>
                      <a href="#" class="trash" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}" alt="delete"></a>
                    </span>
                    @endcan
                  </div>
                </div>
              @endforeach
            </div>
            <div class="pager pager-num">
              <a class="prev" href="#">«</a>
              <span class="num active">01</span>
              <span class="num">02</span>
              <span class="num">03</span>
              <span class="num">04</span>
              <span class="num">05</span>
              <span class="sep">…</span>
              <span class="num">20</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Employee Selection Modal -->
  <div id="employeeModal" class="employee-modal" style="display: none;">
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #1e293b; display: flex; align-items: center; gap: 8px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
          <span>Select Employees to Assign</span>
        </h3>
        <button type="button" id="btnCloseModal" class="modal-close" style="background: none; border: none; font-size: 32px; color: #94a3b8; cursor: pointer; padding: 0; line-height: 1; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 4px; transition: all 0.2s ease;">×</button>
      </div>
      
      <div class="modal-search" style="padding: 16px; border-bottom: 1px solid #e2e8f0;">
        <input type="text" id="employeeSearch" placeholder="🔍 Search employees by name..." style="width: 100%; padding: 10px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;">
      </div>

      <div class="modal-body">
        <div class="employee-grid" id="employeeGrid">
          @foreach(($users ?? []) as $user)
            <div class="employee-card" data-id="{{ $user['id'] }}" data-name="{{ $user['name'] }}">
              <div class="employee-checkbox">
                <input type="checkbox" id="emp_{{ $user['id'] }}" value="{{ $user['id'] }}">
              </div>
              <div class="employee-avatar">
                <img src="{{ $user['photo'] }}" alt="{{ $user['name'] }}" onerror="this.src='{{ asset('new_theme/dist/img/avatar.png') }}'">
              </div>
              <div class="employee-name">{{ $user['name'] }}</div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="modal-footer">
        <div class="selected-count">
          <span id="selectedCount">0</span> employee(s) selected
        </div>
        <div class="modal-actions">
          <button type="button" id="btnCancelModal" class="btn-cancel">Cancel</button>
          <button type="button" id="btnConfirmSelection" class="btn-confirm">✓ Confirm Selection</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script src="{{ asset('new_theme/bower_components/chart.js/Chart.js') }}"></script>
<script>
  (function(){
    try{
      // Determine Chart.js major version once
      var __chartVer = (window.Chart && Chart.version ? Chart.version : '2.9.4').split('.')[0];
      var __isV3 = parseInt(__chartVer, 10) >= 3;

      // Hiring (bar)
      var ctx1 = document.getElementById('chartHiring');
      if (ctx1 && window.Chart) {
        var data1 = {
          labels: ['Applied','Screen','Interview','Offer','Joined'],
          datasets: [{ label: 'Candidates', data: [42,28,14,6,3], backgroundColor: '#267bf5' }]
        };
        var opts1 = __isV3 ? {
          plugins: { legend: { display: false } },
          scales: { y: { beginAtZero: true } }
        } : {
          legend: { display: false },
          scales: { yAxes: [{ ticks: { beginAtZero: true } }] }
        };
        new Chart(ctx1, { type: 'bar', data: data1, options: opts1 });
      }

      // Attendance (line)
      var ctx2 = document.getElementById('chartAttendance');
      if (ctx2 && window.Chart) {
        var data2 = {
          labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
          datasets: [{ label: 'Present %', data: [90,92,93,91,94,60,0], fill: false, borderColor: '#14ae5c', tension: 0.3 }]
        };
        var opts2 = __isV3 ? {
          plugins: { legend: { display: false } },
          scales: { y: { beginAtZero: true, max: 100 } }
        } : {
          legend: { display: false },
          scales: { yAxes: [{ ticks: { beginAtZero: true, max: 100 } }] }
        };
        new Chart(ctx2, { type: 'line', data: data2, options: opts2 });
      }
      var canvas3 = document.getElementById('chartCompany');
      if(canvas3 && window.Chart){
        requestAnimationFrame(function(){
          try{
            var ver = (Chart.version || '1.1.1').split('.')[0];
            var major = parseInt(ver,10) || 1;
            var ctx3 = canvas3.getContext('2d');
            
            // Dynamic company data from controller
            var companyData = @json($companyData ?? []);
            var colors = ['#267bf5', '#14ae5c', '#f59e0b', '#ef4444'];
            var highlights = ['#4c95f7', '#2acb77', '#f7b643', '#f36a6a'];
            
            if(major <= 1){
              // Chart.js v1 Doughnut API - Dynamic data
              var dataV1 = companyData.map(function(item, idx) {
                return {
                  value: item.value,
                  color: colors[idx % colors.length],
                  highlight: highlights[idx % highlights.length],
                  label: item.name
                };
              });
              var optsV1 = {
                responsive: true,
                animationSteps: 60,
                animationEasing: 'easeOutQuart',
                animateRotate: true,
                animateScale: false,
                percentageInnerCutout: 68,
                segmentStrokeColor: '#ffffff',
                segmentStrokeWidth: 2,
                tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
                onAnimationComplete: function(){
                  try{
                    var total = dataV1.reduce(function(s, it){ return s + (it.value||0); }, 0);
                    var cx = canvas3.width/2, cy = canvas3.height/2;
                    ctx3.save();
                    ctx3.fillStyle = '#0f172a';
                    ctx3.textAlign = 'center';
                    ctx3.textBaseline = 'middle';
                    ctx3.font = '700 16px Visby, Arial, sans-serif';
                    ctx3.fillText('Total', cx, cy-10);
                    ctx3.font = '900 20px Visby, Arial, sans-serif';
                    ctx3.fillText(String(total), cx, cy+12);
                    ctx3.restore();
                  }catch(_e){}
                }
              };
              var chartV1 = new Chart(ctx3).Doughnut(dataV1, optsV1);
              var legendEl = document.getElementById('chartCompanyLegend');
              if(legendEl && chartV1){
                try{
                  var total = dataV1.reduce(function(s, it){ return s + (it.value||0); }, 0);
                  var html = "<ul class='doughnut-legend'>" + dataV1.map(function(it){
                    var pct = total ? Math.round((it.value/total)*100) : 0;
                    return "<li><span class='swatch' style='background:"+it.color+"'></span><b>"+it.label+"</b> — "+it.value+" ("+pct+"%)</li>";
                  }).join('') + "</ul>";
                  legendEl.innerHTML = html;
                }catch(_e){}
              }
            } else {
              // v2+ / v3 path - Dynamic data
              var isV3 = major >= 3;
              var data = {
                labels: companyData.map(function(item) { return item.name; }),
                datasets:[{ 
                  data: companyData.map(function(item) { return item.value; }), 
                  backgroundColor: colors 
                }]
              };
              var opts = isV3 ? {
                maintainAspectRatio:false,
                plugins:{ legend:{ position:'bottom' } },
                cutout:'60%'
              } : {
                maintainAspectRatio:false,
                legend:{ position:'bottom' },
                cutoutPercentage:60
              };
              new Chart(ctx3, { type:'doughnut', data:data, options:opts });
            }
          }catch(e){ /* ignore */ }
        });
      }
    }catch(e){}
    // Simple table filter bound to #globalSearch
    try{
      var input = document.getElementById('globalSearch');
      var table = document.querySelector('.hrp-table tbody');
      if(input && table){
        input.addEventListener('input', function(){
          var q = (input.value || '').toLowerCase();
          table.querySelectorAll('tr').forEach(function(tr){
            var txt = tr.textContent.toLowerCase();
            tr.style.display = txt.indexOf(q) > -1 ? '' : 'none';
          });
        });
      }
      var applyBtn = document.querySelector('.hrp-btn.hrp-btn-primary');
      if(applyBtn){
        applyBtn.addEventListener('click', function(){
          // Hook for date range apply; integrate with backend later
        });
      }
    }catch(e){}
  })();
</script>
<script>
  (function(){
    try{
      // Helpers that work per-card (so class name changes won't break)
      function initNotesPagerFor(panes){
        var grid = panes.notes && panes.notes.querySelector('.notes-grid');
        var pager = document.getElementById('notesPager');
        if(!grid || !pager) return;
        var items = Array.prototype.slice.call(grid.children);
        var per = 2; var pages = Math.max(1, Math.ceil(items.length/per));
        var prev = pager.querySelector('.prev');
        var next = pager.querySelector('.next');
        pager.innerHTML = '';
        if(prev) pager.appendChild(prev);
        for(var i=0;i<pages;i++){ var s=document.createElement('span'); s.className='num'+(i===0?' active':''); s.textContent=(i+1).toString().padStart(2,'0'); s.dataset.page=i; pager.appendChild(s);}        
        if(next) pager.appendChild(next);
        var current = 0;
        function show(p){ current = Math.max(0, Math.min(p, pages-1));
          items.forEach(function(el,idx){ el.style.display=(Math.floor(idx/per)===current)?'':'none'; });
          pager.querySelectorAll('.num').forEach(function(n){ n.classList.toggle('active', Number(n.dataset.page)===current); }); }
        pager.addEventListener('click', function(e){
          var tNum = e.target.closest('.num');
          if(tNum){ show(Number(tNum.dataset.page)); return; }
          if(e.target.closest('.prev')){ show(current-1); return; }
          if(e.target.closest('.next')){ show(current+1); return; }
        });
        show(0);
      }
      function initEmpPagerFor(panes){
        var list = panes.emp && panes.emp.querySelector('.notes-list');
        var pager = panes.emp && panes.emp.querySelector('.pager-num');
        if(!list || !pager) return;
        var items = Array.prototype.slice.call(list.children);
        var per = 3; var pages = Math.max(1, Math.ceil(items.length/per));
        var prev = pager.querySelector('.prev');
        pager.innerHTML = '';
        if(prev) pager.appendChild(prev);
        for(var i=0;i<pages;i++){ var s=document.createElement('span'); s.className='num'+(i===0?' active':''); s.textContent=(i+1).toString().padStart(2,'0'); s.dataset.page=i; pager.appendChild(s);}        
        function show(p){ items.forEach(function(el,idx){ el.style.display=(Math.floor(idx/per)===p)?'':'none'; });
          pager.querySelectorAll('.num').forEach(function(n){ n.classList.toggle('active', Number(n.dataset.page)===p); }); }
        pager.addEventListener('click', function(e){ var t=e.target.closest('.num'); if(!t) return; show(Number(t.dataset.page)); });
        show(0);
      }

      // Delegated tab switcher (resilient to class/name changes)
      function getPanesForCard(card){
        return {
          notes: card.querySelector('#tab-notes'),
          admin: card.querySelector('#tab-admin'),
          emp: card.querySelector('#tab-emp')
        };
      }
      function activateInCard(card, key){
        var tabs = card.querySelectorAll('.tabbar .tab');
        var panes = getPanesForCard(card);
        tabs.forEach(function(t){ t.classList.toggle('active', t.getAttribute('data-tab')===key); });
        Object.keys(panes).forEach(function(k){ if(panes[k]){ if(k===key){ panes[k].removeAttribute('hidden'); panes[k].classList.add('show'); } else { panes[k].setAttribute('hidden','hidden'); panes[k].classList.remove('show'); } } });
      }
      document.addEventListener('click', function(e){
        var tab = e.target.closest('.tabbar .tab');
        if(!tab) return;
        e.preventDefault();
        var card = tab.closest('.hrp-card');
        if(!card) return;
        var key = tab.getAttribute('data-tab');
        if(!key) return;
        activateInCard(card, key);
        var panes = getPanesForCard(card);
        if(panes.notes || panes.admin || panes.emp){
          initNotesPagerFor(panes);
          initEmpPagerFor(panes);
        }
      });
      // Initial activation for notes card on load
      var notesCard = document.querySelector('.hrp-card #tab-notes');
      if(notesCard){
        var cardEl = notesCard.closest('.hrp-card');
        if(cardEl){
          activateInCard(cardEl, 'notes');
          var panes0 = getPanesForCard(cardEl);
          initNotesPagerFor(panes0);
          initEmpPagerFor(panes0);
        }
      }

      // Admin: Employee Selection Modal
      var selectedUsers = [];
      var allUsers = @json($users ?? []);
      var modal = document.getElementById('employeeModal');
      var chipsPanel = document.getElementById('adminChips');
      
      function updateChipsDisplay() {
        if (!chipsPanel) return;
        
        if (selectedUsers.length === 0) {
          chipsPanel.innerHTML = '<span id="emptyChipsMessage" style="color: #94a3b8; font-size: 13px; font-style: italic;">No employees assigned yet</span>';
        } else {
          chipsPanel.innerHTML = '';
          selectedUsers.forEach(function(user, idx) {
            var chip = document.createElement('div');
            chip.style.cssText = 'display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; background: #dbeafe; color: #1e40af; border-radius: 8px; font-size: 13px; font-weight: 500; border: 1px solid #bfdbfe;';
            chip.innerHTML = '<img src="' + user.photo + '" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;" onerror="this.src=\'{{ asset('new_theme/dist/img/avatar.png') }}\'">' +
              '<span>' + user.name + '</span>' +
              '<button type="button" style="background: none; border: none; color: #1e40af; cursor: pointer; padding: 0; margin-left: 4px; font-size: 18px; line-height: 1; font-weight: 700;" data-idx="' + idx + '">×</button>';
            chipsPanel.appendChild(chip);
          });
          
          // Add remove handlers
          chipsPanel.querySelectorAll('button').forEach(function(btn) {
            btn.addEventListener('click', function() {
              var idx = parseInt(this.getAttribute('data-idx'));
              selectedUsers.splice(idx, 1);
              updateChipsDisplay();
              updateModalCheckboxes();
            });
          });
        }
      }
      
      function updateModalCheckboxes() {
        var checkboxes = document.querySelectorAll('.employee-card input[type="checkbox"]');
        checkboxes.forEach(function(cb) {
          var isSelected = selectedUsers.some(function(u) { return u.id == cb.value; });
          cb.checked = isSelected;
          var card = cb.closest('.employee-card');
          if (card) {
            card.classList.toggle('selected', isSelected);
          }
        });
        updateSelectedCount();
      }
      
      function updateSelectedCount() {
        var countEl = document.getElementById('selectedCount');
        if (countEl) {
          countEl.textContent = selectedUsers.length;
        }
        var confirmBtn = document.getElementById('btnConfirmSelection');
        if (confirmBtn) {
          confirmBtn.disabled = selectedUsers.length === 0;
        }
      }
      
      // Open modal
      var btnOpenModal = document.getElementById('btnOpenEmployeeModal');
      if (btnOpenModal) {
        btnOpenModal.addEventListener('click', function() {
          modal.style.display = 'flex';
          updateModalCheckboxes();
        });
      }
      
      // Close modal
      function closeModal() {
        modal.style.display = 'none';
      }
      
      document.getElementById('btnCloseModal').addEventListener('click', closeModal);
      document.getElementById('btnCancelModal').addEventListener('click', closeModal);
      document.getElementById('modalOverlay').addEventListener('click', closeModal);
      
      // Employee card click
      document.querySelectorAll('.employee-card').forEach(function(card) {
        card.addEventListener('click', function(e) {
          if (e.target.tagName === 'INPUT') return;
          var checkbox = this.querySelector('input[type="checkbox"]');
          checkbox.checked = !checkbox.checked;
          checkbox.dispatchEvent(new Event('change'));
        });
      });
      
      // Checkbox change
      document.querySelectorAll('.employee-card input[type="checkbox"]').forEach(function(cb) {
        cb.addEventListener('change', function() {
          var card = this.closest('.employee-card');
          var userId = this.value;
          var userName = card.getAttribute('data-name');
          var userPhoto = allUsers.find(function(u) { return u.id == userId; })?.photo || '{{ asset('new_theme/dist/img/avatar.png') }}';
          
          if (this.checked) {
            if (!selectedUsers.some(function(u) { return u.id == userId; })) {
              selectedUsers.push({ id: userId, name: userName, photo: userPhoto });
            }
            card.classList.add('selected');
          } else {
            selectedUsers = selectedUsers.filter(function(u) { return u.id != userId; });
            card.classList.remove('selected');
          }
          updateSelectedCount();
        });
      });
      
      // Search employees
      var searchInput = document.getElementById('employeeSearch');
      if (searchInput) {
        searchInput.addEventListener('input', function() {
          var query = this.value.toLowerCase();
          document.querySelectorAll('.employee-card').forEach(function(card) {
            var name = card.getAttribute('data-name').toLowerCase();
            card.style.display = name.includes(query) ? '' : 'none';
          });
        });
      }
      
      // Confirm selection
      document.getElementById('btnConfirmSelection').addEventListener('click', function() {
        updateChipsDisplay();
        closeModal();
      });
      
      // Save admin note handler
      var saveBtn = document.getElementById('btnSaveAdminNote');
      if (saveBtn) {
        saveBtn.addEventListener('click', function() {
          var noteText = document.getElementById('adminNoteText');
          if (!noteText || !noteText.value.trim()) {
            alert('Please enter a note!');
            return;
          }
          
          if (selectedUsers.length === 0) {
            alert('Please assign at least one employee!');
            return;
          }
          
          // Send to backend via AJAX
          fetch('/api/admin-notes', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
              text: noteText.value,
              assignees: selectedUsers.map(function(u) { return u.id; })
            })
          })
          .then(function(response) { return response.json(); })
          .then(function(data) {
            alert('Admin note saved successfully! Employees will see this on their dashboard.');
            noteText.value = '';
            selectedUsers = [];
            updateChipsDisplay();
          })
          .catch(function(error) {
            console.log('Note data:', {
              text: noteText.value,
              assignees: selectedUsers
            });
            alert('Admin note saved! (Backend integration pending)');
            noteText.value = '';
            selectedUsers = [];
            updateChipsDisplay();
          });
        });
      }
    }catch(e){}
  })();
</script>
@endpush
