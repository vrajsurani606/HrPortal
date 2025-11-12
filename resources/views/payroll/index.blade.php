@extends('layouts.macos')
@section('page_title', 'Payroll')
@section('content')
<div class="hrp-content">
  <!-- Filter Row -->
  <div class="filter-row" style="background: #f8f9fa; padding: 15px; border-radius: 25px; margin-bottom: 20px;">
    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
      <div>
        <input type="date" class="filter-input" placeholder="From : dd/mm/yyyy" style="min-width: 150px;">
      </div>
      <div>
        <input type="date" class="filter-input" placeholder="To : dd/mm/yyyy" style="min-width: 150px;">
      </div>
      <div>
        <select class="filter-select" style="min-width: 130px;">
          <option value="">Payment Mode</option>
          <option value="bank_transfer">Bank Transfer</option>
          <option value="cash">Cash</option>
          <option value="cheque">Cheque</option>
        </select>
      </div>
      <div>
        <select class="filter-select" style="min-width: 130px;">
          <option value="">Payment Type</option>
          <option value="salary">Salary</option>
          <option value="lightbill">Light Bill</option>
          <option value="tea_expense">Tea Expense</option>
          <option value="transportation">Transportation</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="right-actions" style="margin-left: auto; display: flex; gap: 10px;">
        <button class="filter-btn" style="background: #6b7280; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
          <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
          </svg>
        </button>
        <button class="filter-btn" style="background: #6b7280; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
          <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
            <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
          </svg>
        </button>
        <a href="{{ route('payroll.create') }}" class="add-btn" style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 20px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
          <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
          </svg>
        </a>
        <button class="excel-btn" style="background: #10b981; color: white; padding: 8px 16px; border-radius: 20px; border: none; display: flex; align-items: center; gap: 5px;">
          <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
          </svg>
        </button>
        <button class="excel-btn" style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 20px; border: none; display: flex; align-items: center; gap: 5px;">
          <svg width="16" height="16" fill="white" viewBox="0 0 24 24">
            <path d="M17,12H7V10H17V12M15,16H9V14H15V16M17,8H7V6H17V8M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3Z"/>
          </svg>
        </button>
      </div>
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
