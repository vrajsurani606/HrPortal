@extends('layouts.macos')
@section('page_title', 'Payroll')
@section('content')
<div class="hrp-content">
  <!-- Filter Row (Hiring-style) -->
  <div class="jv-filter">
    <input type="date" class="filter-pill" placeholder="From : dd/mm/yyyy">
    <input type="date" class="filter-pill" placeholder="To : dd/mm/yyyy">
    <select class="filter-pill" required>
      <option value="" disabled selected>Payment Mode</option>
      <option value="bank_transfer">Bank Transfer</option>
      <option value="cash">Cash</option>
      <option value="cheque">Cheque</option>
    </select>
    <select class="filter-pill" required>
      <option value="" disabled selected>Payment Type</option>
      <option value="salary">Salary</option>
      <option value="lightbill">Light Bill</option>
      <option value="tea_expense">Tea Expense</option>
      <option value="transportation">Transportation</option>
      <option value="other">Other</option>
    </select>
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
      <input class="filter-pill" placeholder="Search here...">
      <a href="#" title="Export Excel">
        <img src="{{ asset('action_icon/payroll_excel.svg') }}" alt="Excel" width="32" height="32">
      </a>
      <a href="#" title="Download PDF">
        <img src="{{ asset('action_icon/payroll_pdf.svg') }}" alt="PDF" width="32" height="32">
      </a>
      <a href="#" title="Print">
        <img src="{{ asset('action_icon/payroll_print.svg') }}" alt="Print" width="32" height="32">
      </a>
    </div>
  </div>

  <!-- Data Table -->
  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <table>
      <thead>
        <tr>
          <th>Action</th>
          <th>Serial No</th>
          <th>Unique No</th>
          <th>Format Type</th>
          <th>Payment To</th>
          <th>Payment Date</th>
          <th>Payment Amount</th>
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
          <td>CMS/LEAD/OO22</td>
          <td>Salary (OCT-25)</td>
          <td>Hinsu Jeel</td>
          <td>30-10-2025</td>
          <td><strong>11,000</strong></td>
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
          <td>CMS/LEAD/OO23</td>
          <td>Salary (OCT-25)</td>
          <td>Bhaktikumar Savaliya</td>
          <td>14-10-2025</td>
          <td><strong>15,000</strong></td>
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
          <td>CMS/LEAD/OO24</td>
          <td>Other</td>
          <td>Dipesh Vasoya</td>
          <td>29-09-2025</td>
          <td><strong>20,000</strong></td>
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
          <td>CMS/LEAD/OO25</td>
          <td>Salary (JUN-25)</td>
          <td>Piyush Vasani</td>
          <td>28-08-2025</td>
          <td><strong>12,000</strong></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
