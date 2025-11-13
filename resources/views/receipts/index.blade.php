@extends('layouts.macos')
@section('page_title', 'Receipts')
@push('styles')
<link rel="stylesheet" href="{{ asset('new_theme/css/invoice-table.css') }}">
@endpush
@section('content')
<div class="hrp-content">
  <!-- Filter Row -->
  <div class="jv-filter">
    <input type="text" class="filter-pill" placeholder="Receipt No.">
    <input type="date" class="filter-pill" placeholder="From : dd/mm/yyyy">
    <input type="date" class="filter-pill" placeholder="To : dd/mm/yyyy">
    <button type="button" class="filter-search" aria-label="Search">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>
    <div class="filter-right">
      <input class="filter-pill" placeholder="Search here...">
      <a href="{{ route('receipts.create') }}" class="pill-btn pill-success">+ Add</a>
    </div>
  </div>

  <!-- Data Table -->
  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <table>
      <thead>
        <tr>
          <th>Action</th>
          <th>Serial No.</th>
          <th>REC Code.</th>
          <th>Invoice Date.</th>
          <th>Bill No.</th>
          <th>Performa. No.</th>
          <th>Rec. Amount</th>
          <th>Rec. A/C || Cash</th>
          <th>Trans Code</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="action-icons">
              <img src="{{ asset('action_icon/edit.svg') }}" class="action-icon" width="16" height="16">
              <img src="{{ asset('action_icon/delete.svg') }}" class="action-icon" width="16" height="16">
              <img src="{{ asset('action_icon/print.svg') }}" class="action-icon" width="16" height="16">
            </div>
          </td>
          <td>1</td>
          <td>CMS/REC/OO04</td>
          <td>16-07-2025</td>
          <td>2</td>
          <td>1</td>
          <td>1,00,000</td>
          <td>In Account</td>
          <td>fffff</td>
        </tr>
        <tr>
          <td>
            <div class="action-icons">
              <img src="{{ asset('action_icon/edit.svg') }}" class="action-icon" width="16" height="16">
              <img src="{{ asset('action_icon/delete.svg') }}" class="action-icon" width="16" height="16">
              <img src="{{ asset('action_icon/print.svg') }}" class="action-icon" width="16" height="16">
            </div>
          </td>
          <td>2</td>
          <td>CMS/REC/OO05</td>
          <td>16-07-2025</td>
          <td>3</td>
          <td>7</td>
          <td>1,00,000</td>
          <td>In Account</td>
          <td>ggggg</td>
        </tr>
        <tr>
          <td>
            <div class="action-icons">
              <img src="{{ asset('action_icon/edit.svg') }}" class="action-icon" width="16" height="16">
              <img src="{{ asset('action_icon/delete.svg') }}" class="action-icon" width="16" height="16">
              <img src="{{ asset('action_icon/print.svg') }}" class="action-icon" width="16" height="16">
            </div>
          </td>
          <td>3</td>
          <td>CMS/REC/OO06</td>
          <td>16-07-2025</td>
          <td>47</td>
          <td>10</td>
          <td>1,00,000</td>
          <td>In Account</td>
          <td>rrrrr</td>
        </tr>
        <tr>
          <td>
            <div class="action-icons">
              <img src="{{ asset('action_icon/edit.svg') }}" class="action-icon" width="16" height="16">
              <img src="{{ asset('action_icon/delete.svg') }}" class="action-icon" width="16" height="16">
              <img src="{{ asset('action_icon/print.svg') }}" class="action-icon" width="16" height="16">
            </div>
          </td>
          <td>4</td>
          <td>CMS/REC/OO07</td>
          <td>16-07-2025</td>
          <td>5</td>
          <td>15</td>
          <td>1,00,000</td>
          <td>In Account</td>
          <td>eeeee</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
