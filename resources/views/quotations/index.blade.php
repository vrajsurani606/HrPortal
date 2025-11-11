@extends('layouts.macos')
@section('page_title', 'Quotation List')
@section('content')
<div class="inquiry-index-container">
  <div class="filter-row" style="padding: 12px 15px; margin-bottom: 16px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
    <input type="text" placeholder="Quotation No" class="Rectangle-29 hrp-compact" style="height: 38px; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 9999px; font-size: 14px; width: 220px;">
    <input type="text" placeholder="From : dd/mm/yyyy" class="Rectangle-29 hrp-compact" style="height: 38px; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 9999px;font-size: 14px; width: 180px;">
    <input type="text" placeholder="To : dd/mm/yyyy" class="Rectangle-29 hrp-compact" style="height: 38px; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 9999px; font-size: 14px; width: 180px;">
    <button style="width: 38px; height: 38px; background: #e5e7eb; color: #111827; border: none; border-radius: 50%; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" />
        <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2" />
      </svg>
    </button>

    <div style="margin-left: auto; display: flex; gap: 10px; align-items: center;">
      <div style="position: relative; display: flex; align-items: center;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="position: absolute; left: 12px; z-index: 1;">
          <circle cx="11" cy="11" r="8" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="m21 21-4.35-4.35" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <input type="text" id="globalSearch" placeholder="Search here.." class="Rectangle-29 hrp-compact" style="height: 38px; padding: 8px 12px 8px 40px; border: 1px solid #d1d5db; border-radius: 9999px; background: white; font-size: 14px; width: 220px;">
      </div>
      <a href="#" style="height: 38px; display: inline-flex; align-items: center; justify-content: center; background: #10b981; color: white; padding: 0 16px; border-radius: 9999px; text-decoration: none; font-size: 14px;">Excel</a>
    </div>
  </div>

  <div class="inquiry-table">
    <table id="quotationTable" class="display">
      <thead>
        <tr>
          <th>Action</th>
          <th>Serial No.</th>
          <th>Code</th>
          <th>Comp. Name</th>
          <th>Mo.No.</th>
          <th>Update</th>
          <th>Next Update</th>
          <th>Remark</th>
          <th>Is Confirm</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="action-cell" style="display: flex; gap: 3px; align-items: center; width: 140px;">
              <button class="action-btn edit" title="Edit" style="border: none; background: none; padding: 1px;"><img src="{{ asset('action_icon/edit.svg') }}" alt="Edit" style="width: 18px; height: 18px;"></button>
              <a href="#" class="action-btn follow-up" title="Print" style="padding: 1px;"><img src="{{ asset('action_icon/print.svg') }}" alt="Print" style="width: 18px; height: 18px;"></a>
              <button class="action-btn delete" title="Delete" style="border: none; background: none; padding: 1px;"><img src="{{ asset('action_icon/delete.svg') }}" alt="Delete" style="width: 18px; height: 18px;"></button>
              <a href="#" class="action-btn discount" title="Discount" style="padding: 1px;"><img src="{{ asset('action_icon/discount.svg') }}" alt="Discount" style="width: 18px; height: 18px;"></a>
              <a href="{{ route('quotations.create') }}" class="action-btn pluse" title="Add" style="padding: 1px;"><img src="{{ asset('action_icon/pluse.svg') }}" alt="Add" style="width: 18px; height: 18px;"></a>
            </div>
          </td>
          <td>1</td>
          <td>CMS/INQ/0004</td>
          <td>Manglam Consultancy Services</td>
          <td>9316187694</td>
          <td>20/06/2025</td>
          <td>20/06/2025</td>
          <td>Done</td>
          <td>
            <div
              style="width: 20px; height: 20px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <span style="color: white; font-size: 12px;">✓</span>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="action-cell" style="display: flex; gap: 3px; align-items: center; width: 140px;">
              <button class="action-btn edit" title="Edit" style="border: none; background: none; padding: 1px;"><img src="{{ asset('action_icon/edit.svg') }}" alt="Edit" style="width: 18px; height: 18px;"></button>
              <a href="#" class="action-btn follow-up" title="Print" style="padding: 1px;"><img src="{{ asset('action_icon/print.svg') }}" alt="Print" style="width: 18px; height: 18px;"></a>
              <button class="action-btn delete" title="Delete" style="border: none; background: none; padding: 1px;"><img src="{{ asset('action_icon/delete.svg') }}" alt="Delete" style="width: 18px; height: 18px;"></button>
              <a href="#" class="action-btn discount" title="Discount" style="padding: 1px;"><img src="{{ asset('action_icon/discount.svg') }}" alt="Discount" style="width: 18px; height: 18px;"></a>
              <a href="#" class="action-btn pluse" title="Add" style="padding: 1px;"><img src="{{ asset('action_icon/pluse.svg') }}" alt="Add" style="width: 18px; height: 18px;"></a>
            </div>
          </td>
          <td>2</td>
          <td>CMS/INQ/0005</td>
          <td>OWN Company Surat</td>
          <td>9316187694</td>
          <td>20/06/2025</td>
          <td>20/06/2025</td>
          <td>Done</td>
          <td>
            <div
              style="width: 20px; height: 20px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <span style="color: white; font-size: 12px;">✓</span>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="action-cell">
              <button class="action-btn edit" title="Edit"><img src="{{ asset('action_icon/edit.svg') }}"
                  alt="Edit" style="width: 18px; height: 18px;"></button>
              <a href="#" class="action-btn follow-up" title="Follow Up">
                <img src="{{ asset('action_icon/print.svg') }}" alt="Print" style="width: 18px; height: 18px;">
              </a>
              <button class="action-btn delete" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}"
                  alt="Delete" style="width: 18px; height: 18px;"></button>
              <a href="#" class="action-btn discount" title="Discount">
                <img src="{{ asset('action_icon/discount.svg') }}" alt="Discount" style="width: 18px; height: 18px;">
              </a>
              <a href="{{ route('quotations.create') }}" class="action-btn pluse" title="Pluse">
                <img src="{{ asset('action_icon/pluse.svg') }}" alt="Pluse" style="width: 18px; height: 18px;">
              </a>
            </div>
          </td>
          <td>3</td>
          <td>CMS/INQ/0006</td>
          <td>SHREEJI GEOTECH CONSULTA...</td>
          <td>9316187694</td>
          <td>20/06/2025</td>
          <td>20/06/2025</td>
          <td>Done</td>
          <td>
            <div
              style="width: 20px; height: 20px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <span style="color: white; font-size: 12px;">✓</span>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="action-cell">
              <button class="action-btn edit" title="Edit"><img src="{{ asset('action_icon/edit.svg') }}"
                  alt="Edit"></button>
              <a href="#" class="action-btn follow-up" title="Follow Up">
                <img src="{{ asset('action_icon/print.svg') }}" alt="Print">
              </a>
              <button class="action-btn delete" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}"
                  alt="Delete"></button>
              <a href="#" class="action-btn discount" title="Discount">
                <img src="{{ asset('action_icon/discount.svg') }}" alt="Discount" style="width: 18px; height: 18px;">
              </a>
              <a href="{{ route('quotations.create') }}" class="action-btn pluse" title="Pluse">
                <img src="{{ asset('action_icon/pluse.svg') }}" alt="Pluse" style="width: 18px; height: 18px;">
              </a>
            </div>
          </td>
          <td>4</td>
          <td>CMS/INQ/0007</td>
          <td>TECH FAB (INDIA) INDUSTRIES LTD.</td>
          <td>9316187694</td>
          <td>20/06/2025</td>
          <td>20/06/2025</td>
          <td>Done</td>
          <td>
            <div
              style="width: 20px; height: 20px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <span style="color: white; font-size: 12px;">✓</span>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


</div>
@endsection



@push('scripts')
<script src="{{ asset('new_theme/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('new_theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(document).ready(function() {
    var table = $('#quotationTable').DataTable({
      "pageLength": 25,
      "lengthMenu": [
        [10, 25, 50, 100],
        [10, 25, 50, 100]
      ],
      "searching": true,
      "ordering": true,
      "info": false,
      "paging": false,
      "dom": 'rt',
      "autoWidth": false,
      "columnDefs": [{
        "targets": 0,
        "width": "160px",
        "orderable": false
      }],
      "language": {
        "search": "",
        "searchPlaceholder": "Search here..",
        "lengthMenu": "Entries _MENU_",
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "paginate": {
          "first": "<<",
          "last": ">>",
          "next": ">",
          "previous": "<"
        }
      }
    });

    $('#globalSearch').on('keyup', function() {
      table.search(this.value).draw();
    });
  });
</script>
@endpush

@section('breadcrumb')
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