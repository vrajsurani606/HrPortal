@extends('layouts.macos')
@section('page_title', 'Payroll Management')

@section('content')
<div class="hrp-content">
  <!-- Filters -->
  <form method="GET" action="{{ route('payroll.index') }}" class="jv-filter">
    <select class="filter-pill" name="month">
      <option value="">All Months</option>
      @foreach($months as $month)
        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>{{ $month }}</option>
      @endforeach
    </select>

    <select class="filter-pill" name="year">
      <option value="">All Years</option>
      @foreach($years as $year)
        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
      @endforeach
    </select>

    <select class="filter-pill" name="status">
      <option value="">All Status</option>
      <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
      <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
      <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>

    <select class="filter-pill" name="employee_id">
      <option value="">All Employees</option>
      @foreach($employees as $emp)
        <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>{{ $emp->name }}</option>
      @endforeach
    </select>

    <button type="submit" class="filter-search" aria-label="Search">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>

    <a href="{{ route('payroll.index') }}" class="filter-search" aria-label="Refresh">
      <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
      </svg>
    </a>

    <div class="filter-right">
      <input name="q" class="filter-pill" placeholder="Search employee..." value="{{ request('q') }}">
      <button type="button" class="pill-btn pill-success" onclick="openAddPayrollModal()" style="display: flex; align-items: center; gap: 8px;">
        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
          <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
        Add Payroll
      </button>
    </div>
  </form>

  <!-- Data Table -->
  <div class="JV-datatble striped-surface striped-surface--full table-wrap pad-none">
    <table>
      <thead>
        <tr>
          <th style="width: 100px; text-align: center;">Action</th>
          <th style="width: 100px;">EMP Code</th>
          <th style="width: 200px;">Employee</th>
          <th style="width: 120px;">Month</th>
          <th style="width: 80px;">Year</th>
          <th style="width: 130px;">Basic Salary</th>
          <th style="width: 120px;">Allowances</th>
          <th style="width: 100px;">Bonuses</th>
          <th style="width: 120px;">Deductions</th>
          <th style="width: 100px;">Tax</th>
          <th style="width: 130px;">Net Salary</th>
          <th style="width: 120px;">Status</th>
          <th style="width: 130px;">Payment Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($payrolls as $payroll)
          <tr>
            <td style="text-align: center; padding: 14px;">
              <div style="display: inline-flex; gap: 8px; align-items: center;">
                <img src="{{ asset('action_icon/view.svg') }}" alt="View" style="cursor: pointer; width: 18px; height: 18px;" onclick="viewPayroll({{ $payroll->id }})" title="View">
                <img src="{{ asset('action_icon/edit.svg') }}" alt="Edit" style="cursor: pointer; width: 18px; height: 18px;" onclick="editPayroll({{ $payroll->id }})" title="Edit">
                <img src="{{ asset('action_icon/delete.svg') }}" alt="Delete" style="cursor: pointer; width: 18px; height: 18px;" onclick="deletePayroll({{ $payroll->id }})" title="Delete">
              </div>
            </td>
            <td style="padding: 14px 16px;">{{ $payroll->employee->code ?? 'N/A' }}</td>
            <td style="padding: 14px 16px;">{{ $payroll->employee->name ?? 'N/A' }}</td>
            <td style="padding: 14px 16px;">{{ $payroll->month }}</td>
            <td style="padding: 14px 16px;">{{ $payroll->year }}</td>
            <td style="padding: 14px 16px; text-align: right;">₹{{ number_format($payroll->basic_salary, 2) }}</td>
            <td style="padding: 14px 16px; text-align: right;">₹{{ number_format($payroll->allowances, 2) }}</td>
            <td style="padding: 14px 16px; text-align: right;">₹{{ number_format($payroll->bonuses, 2) }}</td>
            <td style="padding: 14px 16px; text-align: right; color: #ef4444;">₹{{ number_format($payroll->deductions, 2) }}</td>
            <td style="padding: 14px 16px; text-align: right; color: #ef4444;">₹{{ number_format($payroll->tax, 2) }}</td>
            <td style="padding: 14px 16px; text-align: right; font-weight: 700; color: #10b981;">₹{{ number_format($payroll->net_salary, 2) }}</td>
            <td style="padding: 14px 16px;">
              @php
                $statusColors = [
                  'pending' => '#f59e0b',
                  'paid' => '#10b981',
                  'cancelled' => '#ef4444',
                ];
                $statusColor = $statusColors[$payroll->status] ?? '#6b7280';
              @endphp
              <span style="color: {{ $statusColor }}; font-weight: 600; font-size: 14px;">{{ ucfirst($payroll->status) }}</span>
            </td>
            <td style="padding: 14px 16px;">{{ $payroll->payment_date ? $payroll->payment_date->format('d M, Y') : '-' }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="13" style="text-align: center; padding: 40px; color: #9ca3af;">
              <p style="font-weight: 600; margin: 0;">No payroll records found</p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($payrolls->hasPages())
  <div style="margin-top: 20px; display: flex; justify-content: center;">
    {{ $payrolls->links() }}
  </div>
  @endif
</div>


<!-- Add/Edit Payroll Modal -->
<div id="payrollModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; overflow-y: auto;">
  <div style="background: white; border-radius: 15px; padding: 30px; max-width: 700px; width: 90%; max-height: 90vh; overflow-y: auto; box-shadow: 0 10px 40px rgba(0,0,0,0.3); margin: 20px;">
    <h3 id="modalTitle" style="margin: 0 0 20px 0; font-size: 22px; font-weight: 700;">Add Payroll</h3>
    
    <form id="payrollForm" onsubmit="submitPayroll(event)">
      <input type="hidden" name="payroll_id" id="payroll_id">
      
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Employee *</label>
          <select name="employee_id" id="payroll_employee_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" onchange="loadEmployeeSalaryData()">
            <option value="">Select Employee</option>
            @foreach($employees as $emp)
              <option value="{{ $emp->id }}" data-salary="{{ $emp->salary ?? 0 }}">{{ $emp->name }} - {{ $emp->code }}</option>
            @endforeach
          </select>
        </div>
        
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Month *</label>
          <select name="month" id="payroll_month" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" onchange="loadEmployeeSalaryData()">
            <option value="">Select Month</option>
            @foreach($months as $month)
              <option value="{{ $month }}" {{ $month == date('F') ? 'selected' : '' }}>{{ $month }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <!-- Employee Info Display -->
      <div id="employee_info" style="display: none; margin-bottom: 15px; padding: 15px; background: #f0f9ff; border: 1px solid #3b82f6; border-radius: 8px;">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; font-size: 13px;">
          <div>
            <span style="color: #6b7280; font-weight: 600;">Working Days:</span>
            <span id="info_working_days" style="color: #1f2937; font-weight: 700;">-</span>
          </div>
          <div>
            <span style="color: #6b7280; font-weight: 600;">Leave Days:</span>
            <span id="info_leave_days" style="color: #ef4444; font-weight: 700;">-</span>
          </div>
          <div>
            <span style="color: #6b7280; font-weight: 600;">Per Day Salary:</span>
            <span id="info_per_day_salary" style="color: #1f2937; font-weight: 700;">-</span>
          </div>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Year *</label>
          <input type="number" name="year" id="payroll_year" required min="2000" max="{{ date('Y') + 1 }}" value="{{ date('Y') }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" onchange="loadEmployeeSalaryData()">
        </div>
        
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Basic Salary *</label>
          <input type="number" name="basic_salary" id="payroll_basic_salary" required min="0" step="0.01" placeholder="0.00" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" oninput="calculateNetSalary()">
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Allowances</label>
          <input type="number" name="allowances" id="payroll_allowances" min="0" step="0.01" placeholder="0.00" value="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" oninput="calculateNetSalary()">
        </div>
        
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Bonuses</label>
          <input type="number" name="bonuses" id="payroll_bonuses" min="0" step="0.01" placeholder="0.00" value="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" oninput="calculateNetSalary()">
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Deductions</label>
          <input type="number" name="deductions" id="payroll_deductions" min="0" step="0.01" placeholder="0.00" value="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" oninput="calculateNetSalary()">
        </div>
        
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Tax</label>
          <input type="number" name="tax" id="payroll_tax" min="0" step="0.01" placeholder="0.00" value="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;" oninput="calculateNetSalary()">
        </div>
      </div>

      <div style="margin-bottom: 15px; padding: 15px; background: #f0fdf4; border: 2px solid #10b981; border-radius: 8px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 700; font-size: 16px; color: #065f46;">Net Salary</label>
        <div id="net_salary_display" style="font-size: 24px; font-weight: 700; color: #10b981;">₹0.00</div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Payment Date</label>
          <input type="date" name="payment_date" id="payroll_payment_date" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
        </div>
        
        <div>
          <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Payment Method</label>
          <select name="payment_method" id="payroll_payment_method" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
            <option value="">Select Method</option>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Cash">Cash</option>
            <option value="Cheque">Cheque</option>
            <option value="UPI">UPI</option>
          </select>
        </div>
      </div>

      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Status *</label>
        <select name="status" id="payroll_status" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;">
          <option value="pending">Pending</option>
          <option value="paid">Paid</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>

      <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px;">Notes</label>
        <textarea name="notes" id="payroll_notes" rows="3" placeholder="Additional notes..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; resize: vertical;"></textarea>
      </div>

      <div style="display: flex; gap: 10px; justify-content: flex-end;">
        <button type="button" onclick="closePayrollModal()" style="padding: 10px 20px; border: 1px solid #ddd; background: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Cancel</button>
        <button type="submit" style="padding: 10px 20px; border: none; background: #10b981; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Save Payroll</button>
      </div>
    </form>
  </div>
</div>

<script>
function openAddPayrollModal() {
  document.getElementById('modalTitle').textContent = 'Add Payroll';
  document.getElementById('payrollForm').reset();
  document.getElementById('payroll_id').value = '';
  document.getElementById('payroll_year').value = new Date().getFullYear();
  
  // Set current month
  const currentMonth = new Date().toLocaleString('default', { month: 'long' });
  document.getElementById('payroll_month').value = currentMonth;
  
  document.getElementById('employee_info').style.display = 'none';
  calculateNetSalary();
  document.getElementById('payrollModal').style.display = 'flex';
}

function loadEmployeeSalaryData() {
  const employeeId = document.getElementById('payroll_employee_id').value;
  const month = document.getElementById('payroll_month').value;
  const year = document.getElementById('payroll_year').value;
  
  if (!employeeId || !month || !year) {
    document.getElementById('employee_info').style.display = 'none';
    return;
  }
  
  // Show loading state
  document.getElementById('employee_info').style.display = 'block';
  document.getElementById('info_working_days').textContent = 'Loading...';
  
  fetch('{{ route("payroll.get-employee-salary") }}', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({
      employee_id: employeeId,
      month: month,
      year: year
    })
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      const data = result.data;
      
      // Auto-fill salary fields
      document.getElementById('payroll_basic_salary').value = data.basic_salary;
      document.getElementById('payroll_allowances').value = data.allowances;
      document.getElementById('payroll_bonuses').value = data.bonuses;
      document.getElementById('payroll_deductions').value = data.deductions;
      document.getElementById('payroll_tax').value = data.tax;
      
      // Update info display
      document.getElementById('info_working_days').textContent = data.working_days + ' / ' + data.days_in_month;
      document.getElementById('info_leave_days').textContent = data.leave_days + ' days';
      document.getElementById('info_per_day_salary').textContent = '₹' + data.per_day_salary;
      
      // Show info panel
      document.getElementById('employee_info').style.display = 'block';
      
      // Recalculate net salary
      calculateNetSalary();
      
      toastr.success('Employee salary data loaded!');
    } else {
      toastr.error('Error loading employee data');
      document.getElementById('employee_info').style.display = 'none';
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toastr.error('Error loading employee data');
    document.getElementById('employee_info').style.display = 'none';
  });
}

function closePayrollModal() {
  document.getElementById('payrollModal').style.display = 'none';
}

function calculateNetSalary() {
  const basicSalary = parseFloat(document.getElementById('payroll_basic_salary').value) || 0;
  const allowances = parseFloat(document.getElementById('payroll_allowances').value) || 0;
  const bonuses = parseFloat(document.getElementById('payroll_bonuses').value) || 0;
  const deductions = parseFloat(document.getElementById('payroll_deductions').value) || 0;
  const tax = parseFloat(document.getElementById('payroll_tax').value) || 0;
  
  const netSalary = (basicSalary + allowances + bonuses) - (deductions + tax);
  document.getElementById('net_salary_display').textContent = '₹' + netSalary.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function submitPayroll(event) {
  event.preventDefault();
  const formData = new FormData(event.target);
  const data = Object.fromEntries(formData);
  const payrollId = data.payroll_id;
  const url = payrollId ? `{{ url('payroll') }}/${payrollId}` : '{{ route("payroll.store") }}';
  
  if (payrollId) {
    formData.append('_method', 'PUT');
  }
  
  fetch(url, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      toastr.success(data.message);
      closePayrollModal();
      setTimeout(() => location.reload(), 1000);
    } else {
      toastr.error('Error: ' + (data.message || 'Unknown error'));
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toastr.error('Error saving payroll');
  });
}

function editPayroll(id) {
  fetch(`{{ url('payroll') }}/${id}/edit`, {
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const payroll = data.payroll;
      document.getElementById('modalTitle').textContent = 'Edit Payroll';
      document.getElementById('payroll_id').value = payroll.id;
      document.getElementById('payroll_employee_id').value = payroll.employee_id;
      document.getElementById('payroll_month').value = payroll.month;
      document.getElementById('payroll_year').value = payroll.year;
      document.getElementById('payroll_basic_salary').value = payroll.basic_salary;
      document.getElementById('payroll_allowances').value = payroll.allowances;
      document.getElementById('payroll_bonuses').value = payroll.bonuses;
      document.getElementById('payroll_deductions').value = payroll.deductions;
      document.getElementById('payroll_tax').value = payroll.tax;
      document.getElementById('payroll_payment_date').value = payroll.payment_date || '';
      document.getElementById('payroll_payment_method').value = payroll.payment_method || '';
      document.getElementById('payroll_status').value = payroll.status;
      document.getElementById('payroll_notes').value = payroll.notes || '';
      calculateNetSalary();
      document.getElementById('payrollModal').style.display = 'flex';
    } else {
      toastr.error('Error loading payroll data');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toastr.error('Error loading payroll data');
  });
}

function viewPayroll(id) {
  window.location.href = `{{ url('payroll') }}/${id}`;
}

function deletePayroll(id) {
  if (typeof Swal === 'undefined') {
    if (confirm('Are you sure you want to delete this payroll record?')) {
      performDeletePayroll(id);
    }
    return;
  }
  
  Swal.fire({
    title: 'Delete Payroll?',
    text: 'Are you sure you want to delete this payroll record? This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, Delete',
    cancelButtonText: 'Cancel',
    width: '400px',
    padding: '1.5rem',
    customClass: { popup: 'perfect-swal-popup' }
  }).then((result) => {
    if (result.isConfirmed) {
      performDeletePayroll(id);
    }
  });
}

function performDeletePayroll(id) {
  const formData = new FormData();
  formData.append('_method', 'DELETE');
  
  fetch(`{{ url('payroll') }}/${id}`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      toastr.success('Payroll deleted successfully!');
      setTimeout(() => location.reload(), 1000);
    } else {
      toastr.error('Error deleting payroll');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    toastr.error('Error deleting payroll');
  });
}
</script>
@endsection
