@extends('layouts.macos')
@section('page_title', 'Create Payroll Entry')

@section('content')
<div class="hrp-content">
  <form id="payrollForm" method="POST" action="{{ route('payroll.store') }}" enctype="multipart/form-data">
    @csrf
    
    <!-- Section 1: Basic Information -->
    <div class="JV-datatble striped-surface striped-surface--full pad-none" style="margin-bottom: 20px;">
      <div style="padding: 20px; border-bottom: 2px solid #e5e7eb;">
        <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1f2937;">Basic Information</h3>
      </div>
      <div style="padding: 25px;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Unique Code:</label>
            <input type="text" name="unique_code" id="unique_code" class="Rectangle-29" placeholder="PAY/2024/0001" readonly style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #f7fafc; color: #718096;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Employee: <span style="color: #ef4444;">*</span></label>
            <select name="employee_id" id="employee_id" class="Rectangle-29 Rectangle-29-select" required onchange="loadEmployeeSalaryData()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Employee</option>
              @foreach($employees as $emp)
                <option value="{{ $emp->id }}">{{ $emp->name }} - {{ $emp->code }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Payment Date: <span style="color: #ef4444;">*</span></label>
            <input type="date" name="payment_date" id="payment_date" class="Rectangle-29" required style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Payment Mode: <span style="color: #ef4444;">*</span></label>
            <select name="payment_mode" id="payment_mode" class="Rectangle-29 Rectangle-29-select" required style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="In Account">In Account</option>
              <option value="Cash">Cash</option>
              <option value="UPI">UPI</option>
              <option value="Cheque">Cheque</option>
            </select>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Bank Name:</label>
            <input type="text" name="bank_name" id="bank_name" class="Rectangle-29" placeholder="Enter Bank Name" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Bank Account No:</label>
            <input type="text" name="bank_account_no" id="bank_account_no" class="Rectangle-29" placeholder="Enter Bank Account No." style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Transaction No:</label>
            <input type="text" name="transaction_no" id="transaction_no" class="Rectangle-29" placeholder="Enter Transaction No." style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
        </div>
      </div>
    </div>

    <!-- Section 2: Salary Period & Attendance -->
    <div class="JV-datatble striped-surface striped-surface--full pad-none" style="margin-bottom: 20px;">
      <div style="padding: 20px; border-bottom: 2px solid #e5e7eb;">
        <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1f2937;">Salary Period & Attendance</h3>
      </div>
      <div style="padding: 25px;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Salary Month: <span style="color: #ef4444;">*</span></label>
            <select name="month" id="month" class="Rectangle-29 Rectangle-29-select" required onchange="loadEmployeeSalaryData()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Month</option>
              @foreach($months as $month)
                <option value="{{ $month }}" {{ $month == date('F') ? 'selected' : '' }}>{{ $month }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Salary Year: <span style="color: #ef4444;">*</span></label>
            <select name="year" id="year" class="Rectangle-29 Rectangle-29-select" required onchange="loadEmployeeSalaryData()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Year</option>
              @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
              @endfor
            </select>
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Total Working Days:</label>
            <select name="total_working_days" id="total_working_days" class="Rectangle-29 Rectangle-29-select" onchange="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Days</option>
              @for($d = 1; $d <= 31; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
            </select>
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Attended Working Days:</label>
            <select name="attended_working_days" id="attended_working_days" class="Rectangle-29 Rectangle-29-select" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Days</option>
              @for($d = 1; $d <= 31; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
            </select>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Taken Leave Casual (P):</label>
            <select name="taken_leave_casual" id="taken_leave_casual" class="Rectangle-29 Rectangle-29-select" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Days</option>
              @for($d = 0; $d <= 30; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
            </select>
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Taken Leave Sick (S):</label>
            <select name="taken_leave_sick" id="taken_leave_sick" class="Rectangle-29 Rectangle-29-select" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Days</option>
              @for($d = 0; $d <= 30; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
            </select>
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Medical Leave:</label>
            <select name="medical_leave" id="medical_leave" class="Rectangle-29 Rectangle-29-select" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Days</option>
              @for($d = 0; $d <= 30; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
            </select>
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Balance Leave (P):</label>
            <select name="balance_leave_casual" id="balance_leave_casual" class="Rectangle-29 Rectangle-29-select" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Days</option>
              @for($d = 0; $d <= 30; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
            </select>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Balance Leave (S):</label>
            <select name="balance_leave_sick" id="balance_leave_sick" class="Rectangle-29 Rectangle-29-select" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Days</option>
              @for($d = 0; $d <= 30; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Section 3: Earnings & Allowances -->
    <div class="JV-datatble striped-surface striped-surface--full pad-none" style="margin-bottom: 20px;">
      <div style="padding: 20px; border-bottom: 2px solid #e5e7eb;">
        <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1f2937;">Earnings & Allowances</h3>
      </div>
      <div style="padding: 25px;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Basic Salary: <span style="color: #ef4444;">*</span></label>
            <input type="number" name="basic_salary" id="basic_salary" class="Rectangle-29" required min="0" step="0.01" placeholder="0.00" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Dearness Allowance:</label>
            <input type="number" name="dearness_allowance" id="dearness_allowance" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">HRA:</label>
            <input type="number" name="hra" id="hra" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Tiffin Allowance:</label>
            <input type="number" name="tiffin_allowance" id="tiffin_allowance" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">City Allowance:</label>
            <input type="number" name="city_allowance" id="city_allowance" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Assistant Allowance:</label>
            <input type="number" name="assistant_allowance" id="assistant_allowance" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Medical Allowance:</label>
            <input type="number" name="medical_allowance" id="medical_allowance" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #10b981;">Total Income:</label>
            <input type="number" name="total_income" id="total_income" class="Rectangle-29" placeholder="0.00" readonly style="width: 100%; padding: 11px 14px; border: 1.5px solid #10b981; border-radius: 8px; font-size: 14px; background: #f0fff4; font-weight: 600; color: #10b981;">
          </div>
        </div>
      </div>
    </div>

    <!-- Section 4: Deductions -->
    <div class="JV-datatble striped-surface striped-surface--full pad-none" style="margin-bottom: 20px;">
      <div style="padding: 20px; border-bottom: 2px solid #e5e7eb;">
        <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1f2937;">Deductions</h3>
      </div>
      <div style="padding: 25px;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">PF:</label>
            <input type="number" name="pf" id="pf" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #fffaf0;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Professional Tax:</label>
            <input type="number" name="professional_tax" id="professional_tax" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #fffaf0;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">TDS:</label>
            <input type="number" name="tds" id="tds" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #fffaf0;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">ESIC:</label>
            <input type="number" name="esic" id="esic" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #fffaf0;">
          </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Security Deposit:</label>
            <input type="number" name="security_deposit" id="security_deposit" class="Rectangle-29" min="0" step="0.01" placeholder="0.00" value="0" oninput="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #fffaf0;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Leave Deduction Days:</label>
            <select name="leave_deduction_days" id="leave_deduction_days" class="Rectangle-29 Rectangle-29-select" onchange="calculateNetSalary()" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
              <option value="">Select Days</option>
              @for($d = 0; $d <= 30; $d++)
                <option value="{{ $d }}">{{ $d }}</option>
              @endfor
            </select>
            <input type="hidden" name="leave_deduction" id="leave_deduction" value="0">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #ef4444;">Deduction Total:</label>
            <input type="number" name="deduction_total" id="deduction_total" class="Rectangle-29" placeholder="0.00" readonly style="width: 100%; padding: 11px 14px; border: 1.5px solid #ef4444; border-radius: 8px; font-size: 14px; background: #fef2f2; font-weight: 600; color: #ef4444;">
          </div>
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #10b981;">Net Salary:</label>
            <input type="number" name="net_salary" id="net_salary" class="Rectangle-29" placeholder="0.00" readonly style="width: 100%; padding: 11px 14px; border: 1.5px solid #10b981; border-radius: 8px; font-size: 16px; background: #f0fff4; font-weight: 700; color: #10b981;">
          </div>
        </div>
      </div>
    </div>

    <!-- Section 5: Resume Upload -->
    <div class="JV-datatble striped-surface striped-surface--full pad-none" style="margin-bottom: 20px;">
      <div style="padding: 20px; border-bottom: 2px solid #e5e7eb;">
        <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1f2937;">Resume Upload</h3>
      </div>
      <div style="padding: 25px;">
        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
          <div>
            <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4a5568;">Resume Upload:</label>
            <input type="file" name="resume" id="resumeInput" class="Rectangle-29" accept=".pdf,.doc,.docx" style="width: 100%; padding: 8px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
          </div>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px;">
      <button type="submit" class="pill-btn pill-success" style="padding: 14px 40px; font-size: 15px; font-weight: 600;">
        Create Payroll Entry
      </button>
    </div>
  </form>
</div>

<script>
// Auto-load employee salary data when employee, month, or year changes
function loadEmployeeSalaryData() {
    const employeeId = document.getElementById('employee_id').value;
    const month = document.getElementById('month').value;
    const year = document.getElementById('year').value;
    
    if (!employeeId || !month || !year) return;
    
    fetch('{{ route("payroll.get-employee-salary") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ employee_id: employeeId, month: month, year: year })
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            const data = result.data;
            
            // Generate unique code
            document.getElementById('unique_code').value = 'PAY/' + year + '/' + String(employeeId).padStart(4, '0');
            
            // Fill attendance data
            setSelectValue('total_working_days', data.days_in_month);
            setSelectValue('attended_working_days', data.working_days);
            setSelectValue('taken_leave_casual', data.leave_days);
            setSelectValue('balance_leave_casual', 12 - data.leave_days);
            setSelectValue('balance_leave_sick', 7);
            setSelectValue('taken_leave_sick', 0);
            setSelectValue('medical_leave', 0);
            
            // Fill salary data
            document.getElementById('basic_salary').value = data.basic_salary;
            
            // Auto-calculate HRA as 40% of basic salary
            const hra = (data.basic_salary * 0.4).toFixed(2);
            document.getElementById('hra').value = hra;
            
            // Auto-calculate Dearness Allowance as 10% of basic salary
            const dearnessAllowance = (data.basic_salary * 0.1).toFixed(2);
            document.getElementById('dearness_allowance').value = dearnessAllowance;
            
            // Auto-calculate PF as 12% of basic salary
            const pf = (data.basic_salary * 0.12).toFixed(2);
            document.getElementById('pf').value = pf;
            
            // Set leave deduction days
            setSelectValue('leave_deduction_days', data.leave_days);
            
            // Calculate net salary
            calculateNetSalary();
            
            if (typeof toastr !== 'undefined') {
                toastr.success('Employee data loaded successfully!');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (typeof toastr !== 'undefined') {
            toastr.error('Error loading employee data');
        }
    });
}

// Helper function to set select dropdown value
function setSelectValue(selectId, value) {
    const select = document.getElementById(selectId);
    if (select && select.tagName === 'SELECT') {
        for (let i = 0; i < select.options.length; i++) {
            if (select.options[i].value == value) {
                select.selectedIndex = i;
                break;
            }
        }
    } else if (select) {
        select.value = value;
    }
}

// Auto-calculate net salary whenever any field changes
function calculateNetSalary() {
    // Get all earnings
    const basicSalary = parseFloat(document.getElementById('basic_salary').value) || 0;
    const dearnessAllowance = parseFloat(document.getElementById('dearness_allowance').value) || 0;
    const hra = parseFloat(document.getElementById('hra').value) || 0;
    const tiffinAllowance = parseFloat(document.getElementById('tiffin_allowance').value) || 0;
    const cityAllowance = parseFloat(document.getElementById('city_allowance').value) || 0;
    const assistantAllowance = parseFloat(document.getElementById('assistant_allowance').value) || 0;
    const medicalAllowance = parseFloat(document.getElementById('medical_allowance').value) || 0;
    
    // Calculate total income
    const totalIncome = basicSalary + dearnessAllowance + hra + tiffinAllowance + cityAllowance + assistantAllowance + medicalAllowance;
    document.getElementById('total_income').value = totalIncome.toFixed(2);
    
    // Get all deductions
    const pf = parseFloat(document.getElementById('pf').value) || 0;
    const professionalTax = parseFloat(document.getElementById('professional_tax').value) || 0;
    const tds = parseFloat(document.getElementById('tds').value) || 0;
    const esic = parseFloat(document.getElementById('esic').value) || 0;
    const securityDeposit = parseFloat(document.getElementById('security_deposit').value) || 0;
    
    // Calculate leave deduction
    const leaveDeductionDays = parseFloat(document.getElementById('leave_deduction_days').value) || 0;
    const totalWorkingDays = parseFloat(document.getElementById('total_working_days').value) || 30;
    const perDaySalary = basicSalary / totalWorkingDays;
    const leaveDeductionAmount = perDaySalary * leaveDeductionDays;
    
    // Store leave deduction amount in hidden field
    document.getElementById('leave_deduction').value = leaveDeductionAmount.toFixed(2);
    
    // Calculate total deductions
    const totalDeductions = pf + professionalTax + tds + esic + securityDeposit + leaveDeductionAmount;
    document.getElementById('deduction_total').value = totalDeductions.toFixed(2);
    
    // Calculate net salary
    const netSalary = totalIncome - totalDeductions;
    document.getElementById('net_salary').value = netSalary.toFixed(2);
}

// Form submission handler
document.getElementById('payrollForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Calculate allowances (all allowances except basic salary)
    const basicSalary = parseFloat(formData.get('basic_salary')) || 0;
    const totalIncome = parseFloat(formData.get('total_income')) || 0;
    const allowances = totalIncome - basicSalary;
    
    // Add additional fields required by backend
    formData.set('allowances', allowances.toFixed(2));
    formData.set('bonuses', 0);
    formData.set('deductions', formData.get('deduction_total'));
    formData.set('tax', formData.get('professional_tax') || 0);
    formData.set('status', 'paid');
    formData.set('payment_method', formData.get('payment_mode'));
    
    fetch('{{ route("payroll.store") }}', {
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
            if (typeof toastr !== 'undefined') {
                toastr.success(data.message || 'Payroll created successfully!');
            }
            setTimeout(() => {
                window.location.href = '{{ route("payroll.index") }}';
            }, 1000);
        } else {
            if (typeof toastr !== 'undefined') {
                toastr.error('Error: ' + (data.message || 'Unknown error'));
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (typeof toastr !== 'undefined') {
            toastr.error('Error saving payroll');
        }
    });
});

// Initialize calculations on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateNetSalary();
});
</script>
@endsection

@section('breadcrumb')
  <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
  <span class="hrp-bc-sep">›</span>
  <a href="{{ route('payroll.index') }}" style="font-weight:800;color:#0f0f0f;text-decoration:none">Payroll</a>
  <span class="hrp-bc-sep">›</span>
  <span class="hrp-bc-current">Create Payroll</span>
@endsection
