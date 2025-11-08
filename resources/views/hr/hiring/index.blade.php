@extends('layouts.macos')
@section('page_title', $page_title)

@section('content')
  <div class="hrp-card">
    <div class="hrp-card-header flex items-center justify-between gap-4">
      <h2 class="hrp-card-title">Hiring Lead Master</h2>
    </div>
    <div class="hrp-card-body">
      <div class="flex flex-wrap items-center gap-3 mb-3">
        <input type="date" class="hrp-input Rectangle-29" style="max-width:220px" placeholder="From: dd/mm/yyyy">
        <input type="date" class="hrp-input Rectangle-29" style="max-width:220px" placeholder="To: dd/mm/yyyy">
        <select class="hrp-input Rectangle-29 Rectangle-29-select" style="max-width:220px">
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
        <select class="hrp-input Rectangle-29 Rectangle-29-select" style="max-width:220px">
          <option value="">Select Experience</option>
          <option value="fresher">Fresher</option>
          <option value=">0">0+</option>
          <option value=">1">1+</option>
          <option value=">2">2+</option>
          <option value=">3">3+</option>
        </select>
        <div class="ml-auto flex items-center gap-3" style="margin-left:auto">
          <input id="globalSearch" class="hrp-input Rectangle-29" style="max-width:320px" placeholder="Search here...">
          <a href="{{ route('hiring.create') }}" class="hrp-btn hrp-btn-primary">+ Add</a>
        </div>
      </div>
      <div class="hrp-table-wrap">
      <table id="hiringTable" class="table table-striped table-hover hrp-table" style="width:100%">
        <thead>
          <tr>
            <th>Action</th>
            <th>Serial No.</th>
            <th>Hiring Lead Code</th>
            <th>Person Name</th>
            <th>Mo. No.</th>
            <th>Address</th>
            <th>Position</th>
            <th>Is Exp.?</th>
            <th>Exp.</th>
            <th>Pre. Company</th>
            <th>Pre. Salary</th>
            <th>Gender</th>
            <th>Resume</th>
          </tr>
        </thead>
        <tbody>
          @forelse($leads as $i => $lead)
            <tr>
              <td class="whitespace-nowrap">
                <div class="action-icons">
                  <a href="{{ route('hiring.edit', $lead) }}" class="action-icon edit" title="Edit" aria-label="Edit">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M4 20h4l10.5-10.5a2 2 0 0 0-2.828-2.828L5.172 17.172 4 20z" fill="white"/></svg>
                  </a>
                  <a href="#" class="action-icon print" title="Print" aria-label="Print">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 9V4h12v5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 17H4a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-2" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><rect x="8" y="15" width="8" height="5" fill="white"/></svg>
                  </a>
                  <form method="POST" action="{{ route('hiring.destroy', $lead) }}" onsubmit="return confirm('Delete this lead?')" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="action-icon delete" title="Delete" aria-label="Delete" type="submit">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M3 6h18" stroke="white" stroke-width="2" stroke-linecap="round"/><path d="M8 6V4h8v2" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 6l1 14h10l1-14" stroke="white" stroke-width="2" stroke-linejoin="round"/></svg>
                    </button>
                  </form>
                  <a href="#" class="action-icon convert" title="Convert to Employee" aria-label="Convert to Employee">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="7" r="3" stroke="white" stroke-width="2"/></svg>
                  </a>
                </div>
              </td>
              <td>{{ ($leads->currentPage()-1) * $leads->perPage() + $i + 1 }}</td>
              <td>{{ $lead->unique_code }}</td>
              <td>{{ $lead->person_name }}</td>
              <td>{{ $lead->mobile_no }}</td>
              <td>{{ $lead->address }}</td>
              <td>{{ $lead->position }}</td>
              <td>{{ $lead->is_experience ? 'Yes' : 'No' }}</td>
              <td>{{ $lead->experience_count }}</td>
              <td>{{ $lead->experience_previous_company }}</td>
              <td>{{ $lead->previous_salary }}</td>
              <td class="capitalize">{{ $lead->gender }}</td>
              <td>
                @if($lead->resume_path)
                  <a class="hrp-link" href="{{ asset('storage/'.$lead->resume_path) }}" target="_blank">View</a>
                @else
                  —
                @endif
              </td>
            </tr>
          @empty
            <tr><td colspan="13" class="text-center py-8">No records found</td></tr>
          @endforelse
        </tbody>
      </table>
      </div>
    </div>
    <div class="hrp-card-footer d-flex align-items-center justify-content-between gap-3 flex-wrap">
      <div id="dtLength" class="text-sm"></div>
      <div id="dtInfo" class="text-sm text-muted" style="margin-left:auto"></div>
      <div id="dtPagination"></div>
    </div>
  </div>
  @php($segments = request()->segments())
  <div class="hrp-breadcrumb">
    <div class="crumb">
      <a href="{{ route('dashboard') }}">Dashboard</a>
      @foreach($segments as $i => $seg)
        @if($i === 0)  ›  <a href="/{{ $seg }}">{{ ucfirst($seg) }}</a>
        @elseif($i === count($segments)-1)  ›  {{ $page_title ?? ucfirst(str_replace('-',' ', $seg)) }}
        @else  ›  <a href="/{{ implode('/', array_slice($segments,0,$i+1)) }}">{{ ucfirst(str_replace('-',' ', $seg)) }}</a>
        @endif
      @endforeach
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('new_theme/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('new_theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function(){
      var dt = $('#hiringTable').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        pageLength: 25,
        order: [[1,'asc']],
        columnDefs: [
          { orderable:false, targets: [0] },
          { searchable:false, targets: [0] }
        ],
        language: {
          search: "",
          searchPlaceholder: "Search..."
        },
        dom: '<"row"<"col-sm-12"tr>>' // render table only; we'll place controls manually
      });
      // place DT controls into footer
      var $wrap = $('#hiringTable').closest('.dataTables_wrapper');
      $wrap.find('.dataTables_length').appendTo('#dtLength');
      $wrap.find('.dataTables_info').appendTo('#dtInfo');
      $wrap.find('.dataTables_paginate').appendTo('#dtPagination');

      $('#globalSearch').on('keyup change', function(){ dt.search(this.value).draw(); });
    });
  </script>
@endpush
