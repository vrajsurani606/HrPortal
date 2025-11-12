@extends('layouts.macos')
@section('page_title', 'Proforma List')
@section('content')

<!-- Filter Row -->
<div class="performa-filter hrp-compact" style="background: #f8f9fa; padding: 12px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
  <input type="text" placeholder="Bill Name" class="Rectangle-29 hrp-compact" style="width: 150px;">
  <input type="text" placeholder="Proforma No." class="Rectangle-29 hrp-compact" style="width: 150px;">
  <input type="text" placeholder="Mobile No." class="Rectangle-29 hrp-compact" style="width: 150px;">
  <input type="text" placeholder="From : dd/mm/yyyy" class="Rectangle-29 hrp-compact" style="width: 170px;">
  <input type="text" placeholder="To : dd/mm/yyyy" class="Rectangle-29 hrp-compact" style="width: 170px;">
  <button style="background: #333; color: white; border: none; border-radius: 50%; width: 35px; height: 35px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
    </svg>
  </button>
  <div style="margin-left: auto; display: flex; gap: 8px;">
    <input type="text" placeholder="Search here.." class="Rectangle-29 hrp-compact" style="padding: 6px 12px; min-width: 160px; background: white;">
    <a href="#" style="background: #28a745; color: white; border: none; border-radius: 20px; padding: 8px 14px; font-size: 12px; font-weight: 600; cursor: pointer; text-decoration: none;">Excel</a>
    <a href="{{ route('performas.create') }}" style="background: #28a745; color: white; border: none; border-radius: 20px; padding: 8px 14px; font-size: 12px; font-weight: 600; cursor: pointer; text-decoration: none;">+ Add</a>
  </div>
</div>
<!-- Data Table -->
<div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
  <table>
    <thead>
      <tr>
        <th>Action</th>
        <th>Serial No.</th>
        <th>Proforma No</th>
        <th>Proforma Date</th>
        <th>Bill To</th>
        <th>Mobile No.</th>
        <th>Grand Total</th>
        <th>Total Tax</th>
        <th>Total Amount</th>
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
            <img class="action-icon" src="{{ asset('action_icon/edit.svg') }}" alt="Edit">
            <img class="action-icon" src="{{ asset('action_icon/delete.svg') }}" alt="Delete">
            <img class="action-icon" src="{{ asset('action_icon/print.svg') }}" alt="Print">
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
            <img class="action-icon" src="{{ asset('action_icon/edit.svg') }}" alt="Edit">
            <img class="action-icon" src="{{ asset('action_icon/delete.svg') }}" alt="Delete">
            <img class="action-icon" src="{{ asset('action_icon/print.svg') }}" alt="Print">
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
            <img class="action-icon" src="{{ asset('action_icon/edit.svg') }}" alt="Edit">
            <img class="action-icon" src="{{ asset('action_icon/delete.svg') }}" alt="Delete">
            <img class="action-icon" src="{{ asset('action_icon/print.svg') }}" alt="Print">
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

@endsection

@section('breadcrumb')
  <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
  <span class="hrp-bc-sep">›</span>
  <a href="{{ route('performas.index') }}">Performas</a>
  <span class="hrp-bc-sep">›</span>
  <span class="hrp-bc-current">Proforma List</span>
@endsection
