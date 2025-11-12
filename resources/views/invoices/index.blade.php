@extends('layouts.macos')
@section('page_title', 'Tax Invoices')
@push('styles')
<link rel="stylesheet" href="{{ asset('new_theme/css/invoice-table.css') }}">
@endpush
@section('content')
<div class="hrp-content">
  <!-- Filter Row -->
  <div class="filter-row">
    <input type="text" class="filter-input" placeholder="Bill Name">
    <input type="text" class="filter-input" placeholder="Proforma No.">
    <input type="text" class="filter-input" placeholder="Mobile No.">
    <input type="date" class="filter-input" placeholder="From : dd/mm/yyyy">
    <input type="date" class="filter-input" placeholder="To : dd/mm/yyyy">
    <div class="right-actions">
      <button class="filter-btn">
        <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
          <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
        </svg>
      </button>
      <input type="text" class="search-input" placeholder="Search here..">
      <button class="excel-btn">Excel</button>
      <a href="#" class="add-btn">+ Add</a>
    </div>
  </div>

  <!-- Data Table -->
  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <table>
      <thead>
        <tr>
          <th>Action</th>
          <th>Serial No.</th>
          <th>Invoice No.</th>
          <th>Invoice Date.</th>
          <th>Bill To</th>
          <th>Mobile. No.</th>
          <th>Grand Total</th>
          <th>Total Tax</th>
          <th>Total Amount</th>
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
          <td>CMS/PFM/OO04</td>
          <td>16-07-2025</td>
          <td>Human Pathology & Clinical Lab</td>
          <td>9316187694</td>
          <td>80,000</td>
          <td>14400</td>
          <td>Scheduled</td>
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
          <td>CMS/PFM/OO05</td>
          <td>16-07-2025</td>
          <td>QC Chemist</td>
          <td>9316187694</td>
          <td>2,80,000</td>
          <td>0</td>
          <td>No</td>
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
          <td>CMS/PFM/OO06</td>
          <td>16-07-2025</td>
          <td>Crest Data</td>
          <td>9316187694</td>
          <td>2,80,000</td>
          <td>0</td>
          <td>Scheduled</td>
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
          <td>CMS/PFM/OO07</td>
          <td>16-07-2025</td>
          <td>Narayan Infotech</td>
          <td>9316187694</td>
          <td>1,40,000</td>
          <td>50000</td>
          <td>Scheduled</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
