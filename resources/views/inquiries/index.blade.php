@extends('layouts.macos')
@section('page_title', 'Inquiries')
@section('content')
<div class="inquiry-index-container">
  <!-- Filter Row -->
  <div class="filter-row">
    <input type="date" id="start_date" class="filter-input" placeholder="From: dd/mm/yyyy">
    <input type="date" id="end_date" class="filter-input" placeholder="To: dd/mm/yyyy">
    <select id="gender_filter" class="filter-select">
      <option value="">Select Gender</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select>
    <select id="experience_filter" class="filter-select">
      <option value="">Select Experience</option>
      <option value="0-1">0-1 Years</option>
      <option value="1-3">1-3 Years</option>
      <option value="3+">3+ Years</option>
    </select>
    <button class="w-12 h-12" id="filter_btn"><img src="{{ asset('action_icon/search svg.svg') }}" alt="Filter"></button>
    <div class="right-actions">
      <div class="search-container">
        <img src="{{ asset('action_icon/search.svg') }}" class="search-icon" alt="Search">
        <input type="text" class="search-input" placeholder="Search here..." id="custom_search">
      </div>
      <button class="excel-btn" id="excel_btn">Excel</button>
      <a href="{{ route('inquiries.create') }}" class="add-btn">+ Add</a>
    </div>
  </div>

  <!-- Table -->
  <div class="inquiry-table">
    <table id="inquiries_table" class="display nowrap" style="width:100%">
      <thead>
        <tr>
          <th>Action</th>
          <th>Serial No.</th>
          <th>Is Confirm</th>
          <th>Code</th>
          <th>Inq. Date</th>
          <th>Comp. Name</th>
          <th>Mo.No.</th>
          <th>Address</th>
          <th>Person Name</th>
          <th>Person Position</th>
          <th>Industry Type</th>
          <th>Scope</th>
          <th>Next Date</th>
          <th>Demo Status</th>
          <th>Demo Date & Time</th>
        </tr>
      </thead>
      <tbody>
        @forelse($inquiries as $index => $inquiry)
        <tr>
          <td class="action-cell">
            <button class="action-btn edit" title="Edit"><img src="{{ asset('action_icon/edit.svg') }}" alt="Edit"></button>
            <button class="action-btn delete" title="Delete"><img src="{{ asset('action_icon/delete.svg') }}" alt="Delete"></button>
            <a href="{{ route('inquiry.follow-up', $inquiry->id) }}" class="action-btn follow-up" title="Follow Up">
                <img src="{{ asset('action_icon/follow-up.svg') }}" alt="Follow Up">
            </a>
            <a href="{{ route('quotation.create-from-inquiry', $inquiry->id) }}" class="action-btn quotation" title="Make Quotation"><img src="{{ asset('action_icon/make-quatation.svg') }}" alt="Make Quotation"></a>
          </td>
          <td>{{ $index + 1 }}</td>
          <td><span class="status-badge confirmed">Confirmed</span></td>
          <td>{{ $inquiry->unique_code }}</td>
          <td>{{ $inquiry->inquiry_date->format('d-m-Y') }}</td>
          <td>{{ $inquiry->company_name }}</td>
          <td>{{ $inquiry->company_phone }}</td>
          <td>{{ Str::limit($inquiry->company_address, 30) }}</td>
          <td>{{ $inquiry->contact_name }}</td>
          <td>{{ $inquiry->contact_position }}</td>
          <td>{{ $inquiry->industry_type }}</td>
          <td><a href="{{ $inquiry->scope_link }}" class="scope-link">View</a></td>
          <td>{{ $inquiry->created_at->addDays(7)->format('d-m-Y') }}</td>
          <td><span class="status-badge scheduled">Scheduled</span></td>
          <td>{{ $inquiry->created_at->addDays(3)->format('d/m/Y') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="15" class="no-data">No inquiries found</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('breadcrumb')
  <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
  <span class="hrp-bc-sep">›</span>
  <span class="hrp-bc-current">Inquiries</span>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#inquiries_table').DataTable({
        scrollX: true,
        scrollY: '400px',
        scrollCollapse: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: false,
        dom: 'rt<"bottom"lip>',
        language: {
            search: "",
            searchPlaceholder: "Search here..."
        },
        columnDefs: [
            { orderable: false, targets: 0 },
            { width: "120px", targets: 0 },
            { width: "80px", targets: 1 },
            { width: "100px", targets: 2 }
        ]
    });

    // Custom search
    $('#custom_search').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Filter button
    $('#filter_btn').on('click', function() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var gender = $('#gender_filter').val();
        var experience = $('#experience_filter').val();
        
        // Apply filters (basic implementation)
        table.draw();
    });

    // Excel export
    $('#excel_btn').on('click', function() {
        // Basic table to CSV export
        var csv = [];
        var rows = document.querySelectorAll('#inquiries_table tr');
        
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            
            for (var j = 1; j < cols.length; j++) { // Skip action column
                var cellText = cols[j].innerText.replace(/,/g, ';');
                row.push('"' + cellText + '"');
            }
            
            csv.push(row.join(','));
        }
        
        var csvFile = new Blob([csv.join('\n')], {type: 'text/csv'});
        var downloadLink = document.createElement('a');
        downloadLink.download = 'inquiries.csv';
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = 'none';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });
});
</script>
@endpush
