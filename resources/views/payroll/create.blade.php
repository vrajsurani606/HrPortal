@extends('layouts.macos')
@section('page_title', 'Create Payroll Entry')
@section('content')
  <div class="hrp-content">
    <form action="#" method="POST" class="hrp-form" enctype="multipart/form-data">
      @csrf
      <div class="Rectangle-30 hrp-compact">
        <!-- Row 1: Basic Info - 4 columns -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Unique Code:</label>
            <input type="text" name="unique_code" class="Rectangle-29" value="CMS/LEAD/OO22" readonly>
          </div>
          <div>
            <label class="hrp-label">Pay Date :</label>
            <input type="date" name="pay_date" class="Rectangle-29" placeholder="dd/mm/yyyy" required>
          </div>
          <div>
            <label class="hrp-label">Pay Type :</label>
            <select name="pay_type" id="payType" class="Rectangle-29-select" required>
              <option value="salary" selected>Salary</option>
              <option value="lightbill">Light Bill</option>
              <option value="tea_expense">Tea Expense</option>
              <option value="transportation">Transportation</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Prepared By:</label>
            <select name="prepared_by" class="Rectangle-29-select" required>
              <option value="">Select Person</option>
              <option value="hr_manager">HR Manager</option>
              <option value="admin">Admin</option>
              <option value="accountant">Accountant</option>
            </select>
          </div>
        </div>

        <!-- Row 2: Employee Info (Only for Salary) -->
        <div id="employeeRow" style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Employee :</label>
            <select name="employee_id" class="Rectangle-29-select">
              <option value="">Select Employee</option>
              <option value="1">John Doe</option>
              <option value="2">Jane Smith</option>
              <option value="3">Mike Johnson</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Vendor Fields (For lightbill, tea_expense, transportation) -->
      <div class="Rectangle-30 hrp-compact" id="vendorFields" style="margin-top: 2rem; display: none;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Vendor Name:</label>
            <input type="text" name="vendor_name" class="Rectangle-29" placeholder="Enter Vendor Name">
          </div>
          <div>
            <label class="hrp-label">Vendor Address:</label>
            <input type="text" name="vendor_address" class="Rectangle-29" placeholder="Enter Vendor Address">
          </div>
          <div>
            <label class="hrp-label">Vendor Gst No:</label>
            <input type="text" name="vendor_gst_no" class="Rectangle-29" placeholder="Enter GST No">
          </div>
          <div>
            <label class="hrp-label">Vendor Pan No:</label>
            <input type="text" name="vendor_pan_no" class="Rectangle-29" placeholder="Enter PAN No">
          </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Total Bill Amount:</label>
            <input type="number" name="total_bill_amount" class="Rectangle-29" placeholder="Enter Amount" step="0.01">
          </div>
          <div>
            <label class="hrp-label">Payment Mode:</label>
            <select name="vendor_payment_mode" class="Rectangle-29-select">
              <option value="">Select Mode</option>
              <option value="bank_transfer">Bank Transfer</option>
              <option value="cash">Cash</option>
              <option value="cheque">Cheque</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Bank Name:</label>
            <input type="text" name="vendor_bank_name" class="Rectangle-29" placeholder="Enter Bank Name">
          </div>
          <div>
            <label class="hrp-label">Bank Account No:</label>
            <input type="text" name="vendor_bank_account" class="Rectangle-29" placeholder="Enter Account No">
          </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Transaction No:</label>
            <input type="text" name="vendor_transaction_no" class="Rectangle-29" placeholder="Enter Transaction No">
          </div>
          <div>
            <label class="hrp-label">Bill Upload:</label>
            <div class="upload-pill">
              <div class="choose">Choose File</div>
              <div class="filename">No File Chosen</div>
              <input type="file" name="bill_upload" accept=".pdf,.jpg,.png,.doc,.docx">
            </div>
          </div>
        </div>
      </div>

      <!-- Other Fields (For 'other' pay type) -->
      <div class="Rectangle-30 hrp-compact" id="otherFields" style="margin-top: 2rem; display: none;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Name:</label>
            <input type="text" name="other_name" class="Rectangle-29" placeholder="Enter Name">
          </div>
          <div>
            <label class="hrp-label">Address:</label>
            <input type="text" name="other_address" class="Rectangle-29" placeholder="Enter Address">
          </div>
          <div>
            <label class="hrp-label">Phone:</label>
            <input type="text" name="other_phone" class="Rectangle-29" placeholder="Enter Phone">
          </div>
          <div>
            <label class="hrp-label">Company Name:</label>
            <input type="text" name="other_company" class="Rectangle-29" placeholder="Enter Company Name">
          </div>
        </div>
        
        <!-- Items Table -->
        <div style="margin-bottom: 1.5rem;">
            <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
              <button type="button" class="inquiry-submit-btn" id="addOtherItem" style="background: #28a745;">+ Add Item</button>
            </div>
          <table style="width: 100%; border-collapse: collapse;">
            <thead>
              <tr style="background: #f8f9fa;">
                <th style="padding: 12px;">Description</th>
                <th style="padding: 12px;">Quantity</th>
                <th style="padding: 12px;">Price</th>
                <th style="padding: 12px;">Total</th>
                <th style="padding: 12px;">Action</th>
              </tr>
            </thead>
            <tbody id="otherItemsTable">
              <tr class="other-item-row">
                <td style="padding: 8px;">
                  <input type="text" name="other_items[0][description]" class="Rectangle-29" placeholder="Enter Description" style="border: none; background: transparent; margin: 0;">
                </td>
                <td style="padding: 8px;">
                  <input type="number" name="other_items[0][quantity]" class="Rectangle-29 other-qty" placeholder="1" style="border: none; background: transparent; margin: 0;">
                </td>
                <td style="padding: 8px;">
                  <input type="number" name="other_items[0][price]" class="Rectangle-29 other-price" placeholder="0.00" step="0.01" style="border: none; background: transparent; margin: 0;">
                </td>
                <td style="padding: 8px;">
                  <input type="number" name="other_items[0][total]" class="Rectangle-29 other-total" placeholder="0.00" readonly style="border: none; background: transparent; margin: 0;">
                </td>
                <td style="padding: 8px; text-align: center;">
                  <button type="button" class="remove-other-item" style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 30px; height: 30px;">×</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Total Bill Amount:</label>
            <input type="number" name="other_total_bill" id="otherTotalBill" class="Rectangle-29" placeholder="0.00" readonly>
          </div>
          <div>
            <label class="hrp-label">Payment Mode:</label>
            <select name="other_payment_mode" class="Rectangle-29-select">
              <option value="">Select Mode</option>
              <option value="in_account">In Account</option>
              <option value="cash">Cash</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Bank Name:</label>
            <input type="text" name="other_bank_name" class="Rectangle-29" placeholder="Enter Bank Name">
          </div>
          <div>
            <label class="hrp-label">Bank Account No:</label>
            <input type="text" name="other_bank_account" class="Rectangle-29" placeholder="Enter Account No">
          </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Transaction No:</label>
            <input type="text" name="other_transaction_no" class="Rectangle-29" placeholder="Enter Transaction No">
          </div>
          <div>
            <label class="hrp-label">Bill Upload:</label>
            <div class="upload-pill">
              <div class="choose">Choose File</div>
              <div class="filename">No File Chosen</div>
              <input type="file" name="other_bill_upload" accept=".pdf,.jpg,.png,.doc,.docx">
            </div>
          </div>
        </div>
      </div>

      <!-- Second Container: Attendance & Leave Info -->
      <div class="Rectangle-30 hrp-compact" id="salaryFields" style="margin-top: 2rem; display: block;">
        <!-- Row 1: Working Days - 4 columns -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Salary Month:</label>
            <select name="salary_month" class="Rectangle-29-select" required>
              <option value="">Select Month</option>
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">June</option>
              <option value="07">July</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Salary Year:</label>
            <select name="salary_year" class="Rectangle-29-select" required>
              <option value="">Select Month</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Total Working Days:</label>
            <select name="total_working_days" class="Rectangle-29-select" required>
              <option value="">Select Month</option>
              <option value="30">30</option>
              <option value="31">31</option>
              <option value="28">28</option>
              <option value="29">29</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Attended Working Days:</label>
            <select name="attended_working_days" class="Rectangle-29-select" required>
              <option value="">Select Month</option>
              <option value="30">30</option>
              <option value="29">29</option>
              <option value="28">28</option>
              <option value="27">27</option>
            </select>
          </div>
        </div>

        <!-- Row 2: Leave Details - 4 columns -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Taken Leave Casual(P):</label>
            <select name="taken_leave_casual" class="Rectangle-29-select">
              <option value="">Select Month</option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Taken Leave (S):</label>
            <select name="taken_leave_sick" class="Rectangle-29-select">
              <option value="">Select Month</option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Medical Leave:</label>
            <select name="medical_leave" class="Rectangle-29-select">
              <option value="">Select Month</option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Balance Leave (P):</label>
            <select name="balance_leave_casual" class="Rectangle-29-select">
              <option value="">Select Month</option>
              <option value="10">10</option>
              <option value="9">9</option>
              <option value="8">8</option>
              <option value="7">7</option>
            </select>
          </div>
        </div>

        <!-- Row 3: Balance Leave (S) - 1 column -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Balance Leave (S):</label>
            <select name="balance_leave_sick" class="Rectangle-29-select">
              <option value="">Select Month</option>
              <option value="10">10</option>
              <option value="9">9</option>
              <option value="8">8</option>
              <option value="7">7</option>
            </select>
          </div>
          <div></div>
          <div></div>
          <div></div>
        </div>
        <!-- Row 1: Basic Salary & Allowances - 4 columns -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Basic Salary:</label>
            <input type="number" name="basic_salary" class="Rectangle-29" placeholder="00" step="0.01" required>
          </div>
          <div>
            <label class="hrp-label">Dearness Allowance:</label>
            <input type="number" name="dearness_allowance" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">HRA:</label>
            <input type="number" name="hra" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">Tiffin Allowance:</label>
            <input type="number" name="tiffin_allowance" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
        </div>

        <!-- Row 2: More Allowances - 4 columns -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">City Compensatory Allo...:</label>
            <input type="number" name="city_compensatory_allowance" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">Assistant Allowance:</label>
            <input type="number" name="assistant_allowance" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">Medical Allowance:</label>
            <input type="number" name="medical_allowance" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">Total Income:</label>
            <input type="number" name="total_income" class="Rectangle-29" placeholder="00" step="0.01" readonly>
          </div>
        </div>

        <!-- Row 3: Deductions - 4 columns -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">PF:</label>
            <input type="number" name="pf" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">Professional Tax:</label>
            <input type="number" name="professional_tax" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">TDS:</label>
            <input type="number" name="tds" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">ESIC:</label>
            <input type="number" name="esic" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
        </div>

        <!-- Row 4: Final Calculations - 4 columns -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Security Deposit:</label>
            <input type="number" name="security_deposit" class="Rectangle-29" placeholder="00" step="0.01">
          </div>
          <div>
            <label class="hrp-label">Leave Diduction:</label>
            <select name="leave_deduction" class="Rectangle-29-select">
              <option value="">Select Month</option>
              <option value="0">0</option>
              <option value="500">500</option>
              <option value="1000">1000</option>
            </select>
          </div>
          <div>
            <label class="hrp-label">Diducton Total:</label>
            <input type="number" name="deduction_total" class="Rectangle-29" placeholder="00" step="0.01" readonly>
          </div>
          <div>
            <label class="hrp-label">Net Salary:</label>
            <input type="number" name="net_salary" class="Rectangle-29" placeholder="00" step="0.01" readonly>
          </div>
        </div>

        <!-- Row 5: Resume Upload -->
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label class="hrp-label">Resume Upload:</label>
            <div class="upload-pill">
              <div class="choose">Choose File</div>
              <div class="filename">No File Chosen</div>
              <input type="file" name="resume" accept=".pdf,.doc,.docx">
            </div>
          </div>
          <div>
            <div>
            </div>
          </div>
        </div>
      </div>
      <div> 
         <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
              <button type="button" class="inquiry-submit-btn" id="addItemBtn" style="background: #28a745;">+ Add Payroll</button>
          </div>
        </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Handle Pay Type Change
      const payTypeSelect = document.getElementById('payType');
      const vendorFields = document.getElementById('vendorFields');
      const otherFields = document.getElementById('otherFields');
      const salaryFields = document.getElementById('salaryFields');
      const employeeRow = document.getElementById('employeeRow');
      
      payTypeSelect.addEventListener('change', function() {
        if (this.value === 'salary') {
          vendorFields.style.display = 'none';
          otherFields.style.display = 'none';
          salaryFields.style.display = 'block';
          employeeRow.style.display = 'grid';
        } else if (this.value === 'lightbill' || this.value === 'tea_expense' || this.value === 'transportation') {
          vendorFields.style.display = 'block';
          otherFields.style.display = 'none';
          salaryFields.style.display = 'none';
          employeeRow.style.display = 'none';
        } else if (this.value === 'other') {
          vendorFields.style.display = 'none';
          otherFields.style.display = 'block';
          salaryFields.style.display = 'none';
          employeeRow.style.display = 'none';
        } else {
          vendorFields.style.display = 'none';
          otherFields.style.display = 'none';
          salaryFields.style.display = 'none';
          employeeRow.style.display = 'none';
        }
      });
      
      // Other Items Calculations
      function calculateOtherItemTotal(row) {
        const qty = parseFloat(row.querySelector('.other-qty').value) || 0;
        const price = parseFloat(row.querySelector('.other-price').value) || 0;
        const total = qty * price;
        row.querySelector('.other-total').value = total.toFixed(2);
        calculateOtherTotalBill();
      }
      
      function calculateOtherTotalBill() {
        let total = 0;
        document.querySelectorAll('.other-total').forEach(input => {
          total += parseFloat(input.value) || 0;
        });
        document.getElementById('otherTotalBill').value = total.toFixed(2);
      }
      
      // Add Other Item
      document.getElementById('addOtherItem').addEventListener('click', function() {
        const table = document.getElementById('otherItemsTable');
        const index = table.querySelectorAll('.other-item-row').length;
        const newRow = document.createElement('tr');
        newRow.className = 'other-item-row';
        newRow.innerHTML = `
          <td style="padding: 8px;">
            <input type="text" name="other_items[${index}][description]" class="Rectangle-29" placeholder="Enter Description" style="border: none; background: transparent; margin: 0;">
          </td>
          <td style="padding: 8px;">
            <input type="number" name="other_items[${index}][quantity]" class="Rectangle-29 other-qty" placeholder="1" style="border: none; background: transparent; margin: 0;">
          </td>
          <td style="padding: 8px;">
            <input type="number" name="other_items[${index}][price]" class="Rectangle-29 other-price" placeholder="0.00" step="0.01" style="border: none; background: transparent; margin: 0;">
          </td>
          <td style="padding: 8px;">
            <input type="number" name="other_items[${index}][total]" class="Rectangle-29 other-total" placeholder="0.00" readonly style="border: none; background: transparent; margin: 0;">
          </td>
          <td style="padding: 8px; text-align: center;">
            <button type="button" class="remove-other-item" style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 30px; height: 30px;">×</button>
          </td>
        `;
        table.appendChild(newRow);
      });
      
      // Remove Other Item
      document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-other-item')) {
          const rows = document.querySelectorAll('.other-item-row');
          if (rows.length > 1) {
            e.target.closest('.other-item-row').remove();
            calculateOtherTotalBill();
          }
        }
      });
      
      // Other Items Input Events
      document.addEventListener('input', function(e) {
        if (e.target.classList.contains('other-qty') || e.target.classList.contains('other-price')) {
          calculateOtherItemTotal(e.target.closest('.other-item-row'));
        }
      });
      // Calculate Total Income
      function calculateTotalIncome() {
        const basicSalary = parseFloat(document.querySelector('input[name="basic_salary"]').value) || 0;
        const dearnessAllowance = parseFloat(document.querySelector('input[name="dearness_allowance"]').value) || 0;
        const hra = parseFloat(document.querySelector('input[name="hra"]').value) || 0;
        const tiffinAllowance = parseFloat(document.querySelector('input[name="tiffin_allowance"]').value) || 0;
        const cityAllowance = parseFloat(document.querySelector('input[name="city_compensatory_allowance"]').value) || 0;
        const assistantAllowance = parseFloat(document.querySelector('input[name="assistant_allowance"]').value) || 0;
        const medicalAllowance = parseFloat(document.querySelector('input[name="medical_allowance"]').value) || 0;

        const totalIncome = basicSalary + dearnessAllowance + hra + tiffinAllowance + cityAllowance + assistantAllowance + medicalAllowance;
        document.querySelector('input[name="total_income"]').value = totalIncome.toFixed(2);
        calculateNetSalary();
      }

      // Calculate Deduction Total
      function calculateDeductionTotal() {
        const pf = parseFloat(document.querySelector('input[name="pf"]').value) || 0;
        const professionalTax = parseFloat(document.querySelector('input[name="professional_tax"]').value) || 0;
        const tds = parseFloat(document.querySelector('input[name="tds"]').value) || 0;
        const esic = parseFloat(document.querySelector('input[name="esic"]').value) || 0;
        const securityDeposit = parseFloat(document.querySelector('input[name="security_deposit"]').value) || 0;
        const leaveDeduction = parseFloat(document.querySelector('select[name="leave_deduction"]').value) || 0;

        const deductionTotal = pf + professionalTax + tds + esic + securityDeposit + leaveDeduction;
        document.querySelector('input[name="deduction_total"]').value = deductionTotal.toFixed(2);
        calculateNetSalary();
      }

      // Calculate Net Salary
      function calculateNetSalary() {
        const totalIncome = parseFloat(document.querySelector('input[name="total_income"]').value) || 0;
        const deductionTotal = parseFloat(document.querySelector('input[name="deduction_total"]').value) || 0;
        const netSalary = totalIncome - deductionTotal;
        document.querySelector('input[name="net_salary"]').value = netSalary.toFixed(2);
      }

      // Add event listeners for income fields
      const incomeFields = ['basic_salary', 'dearness_allowance', 'hra', 'tiffin_allowance', 'city_compensatory_allowance', 'assistant_allowance', 'medical_allowance'];
      incomeFields.forEach(field => {
        document.querySelector(`input[name="${field}"]`).addEventListener('input', calculateTotalIncome);
      });

      // Add event listeners for deduction fields
      const deductionFields = ['pf', 'professional_tax', 'tds', 'esic', 'security_deposit'];
      deductionFields.forEach(field => {
        document.querySelector(`input[name="${field}"]`).addEventListener('input', calculateDeductionTotal);
      });

      if (document.querySelector('select[name="leave_deduction"]')) {
        document.querySelector('select[name="leave_deduction"]').addEventListener('change', calculateDeductionTotal);
      }
    });
  </script>
@endsection