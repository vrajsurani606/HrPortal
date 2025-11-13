@extends('layouts.macos')
@section('page_title', 'Ticket Support')

@section('content')
<div class="hrp-content">
  <div class="jv-filter">
    <select class="filter-pill" name="company" form="ticketFilters" required>
      <option value="" disabled selected>Select Company</option>
      @foreach($companies as $company)
        <option value="{{ $company }}" {{ request('company')===$company ? 'selected' : '' }}>{{ $company }}</option>
      @endforeach
    </select>
    <select class="filter-pill" name="ticket_type" form="ticketFilters" required>
      <option value="" disabled selected>Select Ticket Type</option>
      @foreach($types as $type)
        <option value="{{ $type }}" {{ request('ticket_type')===$type ? 'selected' : '' }}>{{ $type }}</option>
      @endforeach
    </select>
    <button type="submit" class="filter-search" aria-label="Search" form="ticketFilters">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>
    <div class="filter-right">
      <input id="globalSearch" name="q" class="filter-pill" placeholder="Search here..." form="ticketFilters" value="{{ request('q') }}">
      <a href="#" class="pill-btn pill-success">Excel</a>
    </div>
    <form id="ticketFilters" method="GET" novalidate></form>
  </div>

  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <table>
      <thead>
        <tr>
          <th>Action</th>
          <th>Serial No.</th>
          <th>Ticket</th>
          <th>Work by Emp.</th>
          <th>Category</th>
          <th>Customer</th>
          <th>Title</th>
          <th>Discription</th>
        </tr>
      </thead>
      <tbody>
        @forelse($tickets as $i => $t)
          <tr>
            <td>
              <a href="#" title="View" aria-label="View"><img src="{{ asset('action_icon/view.svg') }}" alt="View" class="action-icon"></a>
              <form action="{{ route('tickets.destroy', $t) }}" method="POST" style="display:inline;" data-ajax>
                @csrf
                @method('DELETE')
                <button type="submit" class="js-confirm-delete" title="Delete" aria-label="Delete" data-ajax data-success="Ticket deleted">
                  <img src="{{ asset('action_icon/delete.svg') }}" alt="Delete" class="action-icon">
                </button>
              </form>
            </td>
            <td>{{ ($tickets->currentPage()-1) * $tickets->perPage() + $i + 1 }}</td>
            <td>{{ ucfirst($t->status) }}</td>
            <td>{{ $t->work_status ? str_replace('_',' ',ucwords($t->work_status)) : '' }}</td>
            <td>{{ $t->category }}</td>
            <td>{{ $t->customer }}</td>
            <td>{{ $t->title }}</td>
            <td>{{ $t->description }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="8">No records found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
