@extends('layouts.macos')
@section('page_title', 'Companies')
@section('content')
<div class="hrp-card">
  <div class="hrp-card-header" style="padding: 12px 15px; display: flex; gap: 12px; align-items: center;">
    <div style="position: relative; flex: 1; min-width: 260px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); pointer-events: none;">
        <circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="m21 21-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <input type="text" id="globalSearch" placeholder="Type to search.." class="Rectangle-29 hrp-compact" style="height: 38px; width: 260px; padding: 8px 16px 8px 42px; border: 1px solid #d1d5db; border-radius: 9999px; background: white; font-size: 14px;">
    </div>
    <button type="button" title="Print" style="width: 38px; height: 38px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e5e7eb; background: #fff;">
      <img src="{{ asset('action_icon/print.svg') }}" alt="print" style="width: 18px; height: 18px;">
    </button>
    <button type="button" title="Export" style="width: 38px; height: 38px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e5e7eb; background: #fff;">
      <img src="{{ asset('action_icon/excel.svg') }}" alt="export" style="width: 18px; height: 18px;">
    </button>
  </div>
  <div class="hrp-card-body">
    <div class="hrp-table-surface">
      <div class="overflow-x-auto bg-white rounded">
        <table id="companiesTable" class="display min-w-full">
          <thead>
            <tr>
              <th class="text-left px-4 py-3">Action</th>
              <th class="text-left px-4 py-3">Serial No</th>
              <th class="text-left px-4 py-3">Com. Code</th>
              <th class="text-left px-4 py-3">Company Name</th>
              <th class="text-left px-4 py-3">GST No.</th>
              <th class="text-left px-4 py-3">Person Name</th>
              <th class="text-left px-4 py-3">Mobile Number</th>
              <th class="text-left px-4 py-3">Position</th>
              <th class="text-left px-4 py-3">Address</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="action-cell">
                <a href="{{ route('companies.show', 1) }}" class="action-btn show" title="Show">
                  <img src="{{ asset('action_icon/view.svg') }}" alt="Show">
                </a>
                <button class="action-btn edit" title="Edit"><img src="{{ asset('action_icon/edit.svg') }}" alt="Edit"></button>
                <button class="action-btn delete" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}" alt="Delete"></button>
              </td>
              <td class="px-4 py-3">1</td>
              <td class="px-4 py-3">CMS/COM/0022</td>
              <td class="px-4 py-3">Manglam Consultancy Services</td>
              <td class="px-4 py-3">24ABAFM0105D1Z8</td>
              <td class="px-4 py-3">Pratikbhai Desai</td>
              <td class="px-4 py-3">9824042821</td>
              <td class="px-4 py-3">Partner</td>
              <td class="px-4 py-3">Vallabhkrupa, Ellora Park, Surat</td>
            </tr>
            <tr class="border-t">
            <td class="action-cell">
                <a href="{{ route('companies.show', 1) }}" class="action-btn show" title="Show">
                  <img src="{{ asset('action_icon/view.svg') }}" alt="Show">
                </a>
                <button class="action-btn edit" title="Edit"><img src="{{ asset('action_icon/edit.svg') }}" alt="Edit"></button>
                <button class="action-btn delete" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}" alt="Delete"></button>
              </td>
              <td class="px-4 py-3">2</td>
              <td class="px-4 py-3">CMS/COM/0023</td>
              <td class="px-4 py-3">Manglam Consultancy Services</td>
              <td class="px-4 py-3">24ABAFM0105D1Z8</td>
              <td class="px-4 py-3">Pratikbhai Desai</td>
              <td class="px-4 py-3">9824042821</td>
              <td class="px-4 py-3">Partner</td>
              <td class="px-4 py-3">Vallabhkrupa, Ellora Park, Surat</td>
            </tr>
            <tr class="border-t">
             <td class="action-cell">
                <a href="{{ route('companies.show', 1) }}" class="action-btn show" title="Show">
                  <img src="{{ asset('action_icon/view.svg') }}" alt="Show">
                </a>
                <button class="action-btn edit" title="Edit"><img src="{{ asset('action_icon/edit.svg') }}" alt="Edit"></button>
                <button class="action-btn delete" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}" alt="Delete"></button>
              </td>
              <td class="px-4 py-3">3</td>
              <td class="px-4 py-3">CMS/COM/0024</td>
              <td class="px-4 py-3">Manglam Consultancy Services</td>
              <td class="px-4 py-3">24ABAFM0105D1Z8</td>
              <td class="px-4 py-3">Pratikbhai Desai</td>
              <td class="px-4 py-3">9824042821</td>
              <td class="px-4 py-3">Owner</td>
              <td class="px-4 py-3">Vallabhkrupa, Ellora Park, Surat</td>
            </tr>
            <tr class="border-t">
             <td class="action-cell">
                <a href="{{ route('companies.show', 1) }}" class="action-btn show" title="Show">
                  <img src="{{ asset('action_icon/view.svg') }}" alt="Show">
                </a>
                <button class="action-btn edit" title="Edit"><img src="{{ asset('action_icon/edit.svg') }}" alt="Edit"></button>
                <button class="action-btn delete" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}" alt="Delete"></button>
              </td>
              <td class="px-4 py-3">4</td>
              <td class="px-4 py-3">CMS/COM/0025</td>
              <td class="px-4 py-3">Manglam Consultancy Services</td>
              <td class="px-4 py-3">24ABAFM0105D1Z8</td>
              <td class="px-4 py-3">Pratikbhai Desai</td>
              <td class="px-4 py-3">9824042821</td>
              <td class="px-4 py-3">Partner</td>
              <td class="px-4 py-3">Vallabhkrupa, Ellora Park, Surat</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('new_theme/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('new_theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(document).ready(function() {
    var table = $('#companiesTable').DataTable({
      pageLength: 25,
      lengthMenu: [
        [10, 25, 50, 100],
        [10, 25, 50, 100]
      ],
      searching: true,
      ordering: true,
      info: false,
      paging: false,
      dom: 'rt',
      autoWidth: false,
      columnDefs: [{
        targets: 0,
        width: '120px',
        orderable: false
      }],
      language: {
        search: '',
        searchPlaceholder: 'Search here..',
        lengthMenu: 'Entries _MENU_'
      }
    });

    $('#globalSearch').on('keyup', function() {
      table.search(this.value).draw();
    });
  });
</script>
@endpush

@section('breadcrumb')
<a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
<span class="hrp-bc-sep">›</span>
<span class="hrp-bc-current">Companies</span>
@endsection

@section('footer_pagination')
<div style="display: flex; align-items: center; gap: 8px;">
  <button style="background: #f3f4f6; border: 1px solid #d1d5db; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 12px;">«</button>
  <a href="#" style="background: #ef4444; color: white; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 12px; min-width: 24px; text-align: center;">01</a>
  <a href="#" style="background: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 12px; min-width: 24px; text-align: center;">02</a>
  <a href="#" style="background: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 12px; min-width: 24px; text-align: center;">03</a>
  <a href="#" style="background: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-size: 12px; min-width: 24px; text-align: center;">04</a>
  <button style="background: #f3f4f6; border: 1px solid #d1d5db; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 12px;">»</button>
</div>
<div style="font-size: 12px; color: #6b7280; display: flex; align-items: center; gap: 8px; margin-left: 20px;">
  Entries
  <select style="border: 1px solid #d1d5db; background: white; padding: 2px 6px; border-radius: 4px; font-size: 12px;">
    <option>25</option>
    <option>50</option>
    <option>100</option>
  </select>
</div>
@endsection