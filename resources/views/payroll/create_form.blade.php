<style>
.payroll-form-container {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 15px;
    max-width: 1400px;
    margin: 0 auto;
}

.form-section {
    background: white;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 20px;
}

.form-row-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 20px;
}

.form-row-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 8px;
    display: block;
}

.form-input, .form-select {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    background: #ffffff;
    transition: all 0.2s ease;
    color: #2d3748;
}

.form-input:focus, .form-select:focus {
    outline: none;
    border-color: #4299e1;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
}

.form-input::placeholder {
    color: #cbd5e0;
}

.form-input:read-only {
    background: #f7fafc;
    color: #718096;
    cursor: not-allowed;
}

.calculated-field {
    background: #f0fff4 !important;
    font-weight: 600;
    color: #22543d;
}

.deduction-field {
    background: #fffaf0 !important;
}

.submit-btn {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    padding: 14px 40px;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(72, 187, 120, 0.4);
    transition: all 0.3s ease;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(72, 187, 120, 0.5);
}

.cancel-btn {
    background: #e2e8f0;
    color: #4a5568;
    padding: 14px 40px;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.cancel-btn:hover {
    background: #cbd5e0;
}
</style>

<div class="payroll-form-container">
    <form id="comprehensivePayrollForm" onsubmit="submitComprehensivePayroll(event)">
        <input type="hidden" name="payroll_id" id="comp_payroll_id">
        
        <!-- Section 1: Top Row -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Unique Code:</label>
                    <input type="text" name="unique_code" id="unique_code" class="form-input" placeholder="CMG/LEAD/0022" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Pay Date:</label>
                    <input type="date" name="payment_date" id="comp_payment_date" class="form-input" placeholder="dd/mm/yyyy" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Pay Type:</label>
                    <select name="pay_type" id="pay_type" class="form-select" required>
                        <option value="Salary">Salary</option>
                        <option value="Bonus">Bonus</option>
                        <option value="Incentive">Incentive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Prepared By:</label>
                    <select name="prepared_by" id="prepared_by" class="form-select">
                        <option value="">Select Person</option>
                        <option value="HR Manager">HR Manager</option>
                        <option value="Finance Manager">Finance Manager</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="form-row-3">
                <div class="form-group">
                    <label class="form-label">Employee:</label>
                    <select name="employee_id" id="comp_employee_id" class="form-select" required onchange="loadComprehensiveEmployeeData()">
                        <option value="">Select Employee</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }} - {{ $emp->code }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Mode:</label>
                    <select name="payment_mode" id="payment_mode" class="form-select" required>
                        <option value="In Account">In Account</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="UPI">UPI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Bank Name:</label>
                    <input type="text" name="bank_name" id="bank_name" class="form-input" placeholder="Enter Bank Name">
                </div>
            </div>

            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Bank Account No:</label>
                    <input type="text" name="bank_account_no" id="bank_account_no" class="form-input" placeholder="Enter Bank Account No.">
                </div>
                <div class="form-group">
                    <label class="form-label">Transaction No:</label>
                    <input type="text" name="transaction_no" id="transaction_no" class="form-input" placeholder="Enter Transaction No.">
                </div>
            </div>
        </div>

        <!-- Section 2: Salary Period & Attendance -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Salary Month:</label>
                    <select name="month" id="comp_month" class="form-select" required onchange="loadComprehensiveEmployeeData()">
                        <option value="">Select Month</option>
                        @foreach($months as $month)
                            <option value="{{ $month }}" {{ $month == date('F') ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Salary Year:</label>
                    <select name="year" id="comp_year" class="form-select" required onchange="loadComprehensiveEmployeeData()">
                        <option value="">Select Month</option>
                        @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                            <option value="{{ $y }}" {{ $y == date('Y') ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Total Working Days:</label>
                    <select name="total_working_days" id="total_working_days" class="form-select">
                        <option value="">Select Month</option>
                        @for($d = 1; $d <= 31; $d++)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Attended Working Days:</label>
                    <select name="attended_working_days" id="attended_working_days" class="form-select">
                        <option value="">Select Month</option>
                        @for($d = 1; $d <= 31; $d++)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Taken Leave Casual(P):</label>
                    <select name="taken_leave_casual" id="taken_leave_casual" class="form-select">
                        <option value="">Select Month</option>
                        @for($d = 0; $d <= 30; $d++)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Taken Leave (S):</label>
                    <select name="taken_leave_sick" id="taken_leave_sick" class="form-select">
                        <option value="">Select Month</option>
                        @for($d = 0; $d <= 30; $d++)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Medical Leave:</label>
                    <select name="medical_leave" id="medical_leave" class="form-select">
                        <option value="">Select Month</option>
                        @for($d = 0; $d <= 30; $d++)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Balance Leave (P):</label>
                    <select name="balance_leave_casual" id="balance_leave_casual" class="form-select">
                        <option value="">Select Month</option>
                        @for($d = 0; $d <= 30; $d++)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Balance Leave (S):</label>
                    <select name="balance_leave_sick" id="balance_leave_sick" class="form-select">
                        <option value="">Select Month</option>
                        @for($d = 0; $d <= 30; $d++)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <!-- Section 3: Earnings & Allowances -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Basic Salary:</label>
                    <input type="number" name="basic_salary" id="comp_basic_salary" class="form-input" required min="0" step="0.01" placeholder="0.0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">Dearness Allowance:</label>
                    <input type="number" name="dearness_allowance" id="dearness_allowance" class="form-input" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">HRA:</label>
                    <input type="number" name="hra" id="hra" class="form-input" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">Tiffin Allowance:</label>
                    <input type="number" name="tiffin_allowance" id="tiffin_allowance" class="form-input" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">City Compensatory Allo...:</label>
                    <input type="number" name="city_allowance" id="city_allowance" class="form-input" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">Assistant Allowance:</label>
                    <input type="number" name="assistant_allowance" id="assistant_allowance" class="form-input" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">Medical Allowance:</label>
                    <input type="number" name="medical_allowance" id="medical_allowance" class="form-input" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">Total Income:</label>
                    <input type="number" name="total_income" id="total_income" class="form-input calculated-field" placeholder="0.0" readonly>
                </div>
            </div>
        </div>

        <!-- Section 4: Deductions -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">PF:</label>
                    <input type="number" name="pf" id="pf" class="form-input deduction-field" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">Professional Tax:</label>
                    <input type="number" name="professional_tax" id="professional_tax" class="form-input deduction-field" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">TDS:</label>
                    <input type="number" name="tds" id="tds" class="form-input deduction-field" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">ESIC:</label>
                    <input type="number" name="esic" id="esic" class="form-input deduction-field" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Security Deposit:</label>
                    <input type="number" name="security_deposit" id="security_deposit" class="form-input deduction-field" min="0" step="0.01" placeholder="0.0" value="0" oninput="calculateComprehensiveNetSalary()">
                </div>
                <div class="form-group">
                    <label class="form-label">Leave Diduction:</label>
                    <select name="leave_deduction" id="leave_deduction" class="form-select">
                        <option value="">Select Month</option>
                        @for($d = 0; $d <= 30; $d++)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Diducton Total:</label>
                    <input type="number" name="deduction_total" id="deduction_total" class="form-input calculated-field" placeholder="0.0" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Net Salary:</label>
                    <input type="number" name="net_salary" id="comp_net_salary" class="form-input calculated-field" placeholder="0.0" readonly style="font-size: 16px; font-weight: 700;">
                </div>
            </div>
        </div>

        <!-- Section 5: Resume Upload -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Resume Upload:</label>
                    <input type="file" name="resume" id="resume" class="form-input" accept=".pdf,.doc,.docx" style="padding: 8px 14px;">
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px;">
            <button type="button" onclick="closePayrollModal()" class="cancel-btn">
                Cancel
            </button>
            <button type="submit" class="submit-btn">
                Add Hiring Lead Master
            </button>
        </div>
    </form>
</div>

<script>
function loadComprehensiveEmployeeData() {
    const employeeId = document.getElementById('comp_employee_id').value;
    const month = document.getElementById('comp_month').value;
    const year = document.getElementById('comp_year').value;
    
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
            
            // Fill attendance data - set selected option for dropdowns
            setSelectValue('total_working_days', data.days_in_month);
            setSelectValue('attended_working_days', data.working_days);
            setSelectValue('taken_leave_casual', data.leave_days);
            setSelectValue('balance_leave_casual', 12 - data.leave_days);
            setSelectValue('balance_leave_sick', 7);
            setSelectValue('taken_leave_sick', 0);
            setSelectValue('medical_leave', 0);
            
            // Fill salary data
            document.getElementById('comp_basic_salary').value = data.basic_salary;
            
            // Auto-calculate HRA as 40% of basic salary
            const hra = (data.basic_salary * 0.4).toFixed(2);
            document.getElementById('hra').value = hra;
            
            // Auto-calculate PF as 12% of basic salary
            const pf = (data.basic_salary * 0.12).toFixed(2);
            document.getElementById('pf').value = pf;
            
            // Set leave deduction
            setSelectValue('leave_deduction', data.leave_days);
            
            calculateComprehensiveNetSalary();
            
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

function setSelectValue(selectId, value) {
    const select = document.getElementById(selectId);
    if (select && select.tagName === 'SELECT') {
        // Find and select the option with matching value
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

function calculateComprehensiveNetSalary() {
    // Get all earnings
    const basicSalary = parseFloat(document.getElementById('comp_basic_salary').value) || 0;
    const dearnessAllowance = parseFloat(document.getElementById('dearness_allowance').value) || 0;
    const hra = parseFloat(document.getElementById('hra').value) || 0;
    const tiffinAllowance = parseFloat(document.getElementById('tiffin_allowance').value) || 0;
    const cityAllowance = parseFloat(document.getElementById('city_allowance').value) || 0;
    const assistantAllowance = parseFloat(document.getElementById('assistant_allowance').value) || 0;
    const medicalAllowance = parseFloat(document.getElementById('medical_allowance').value) || 0;
    
    // Calculate total income
    const totalIncome = basicSalary + dearnessAllowance + hra + tiffinAllowance + cityAllowance + assistantAllowance + medicalAllowance;
    document.getElementById('total_income').value = totalIncome.toFixed(1);
    
    // Get all deductions
    const pf = parseFloat(document.getElementById('pf').value) || 0;
    const professionalTax = parseFloat(document.getElementById('professional_tax').value) || 0;
    const tds = parseFloat(document.getElementById('tds').value) || 0;
    const esic = parseFloat(document.getElementById('esic').value) || 0;
    const securityDeposit = parseFloat(document.getElementById('security_deposit').value) || 0;
    
    // Get leave deduction from select dropdown
    const leaveDeductionSelect = document.getElementById('leave_deduction');
    const leaveDays = parseFloat(leaveDeductionSelect.value) || 0;
    
    // Calculate leave deduction amount (assuming per day salary)
    const totalWorkingDaysSelect = document.getElementById('total_working_days');
    const totalWorkingDays = parseFloat(totalWorkingDaysSelect.value) || 30;
    const perDaySalary = basicSalary / totalWorkingDays;
    const leaveDeductionAmount = perDaySalary * leaveDays;
    
    // Calculate total deductions
    const totalDeductions = pf + professionalTax + tds + esic + securityDeposit + leaveDeductionAmount;
    document.getElementById('deduction_total').value = totalDeductions.toFixed(1);
    
    // Calculate net salary
    const netSalary = totalIncome - totalDeductions;
    document.getElementById('comp_net_salary').value = netSalary.toFixed(1);
}

function submitComprehensivePayroll(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    const payrollId = formData.get('payroll_id');
    const url = payrollId ? `{{ url('payroll') }}/${payrollId}` : '{{ route("payroll.store") }}';
    
    if (payrollId) {
        formData.append('_method', 'PUT');
    }
    
    // Calculate allowances (all allowances except basic salary)
    const basicSalary = parseFloat(formData.get('basic_salary')) || 0;
    const totalIncome = parseFloat(formData.get('total_income')) || 0;
    const allowances = totalIncome - basicSalary;
    
    // Map comprehensive form fields to existing payroll fields
    formData.set('allowances', allowances.toFixed(2));
    formData.set('bonuses', 0);
    formData.set('deductions', formData.get('deduction_total'));
    formData.set('tax', formData.get('professional_tax') || 0);
    formData.set('status', 'paid');
    
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
            if (typeof toastr !== 'undefined') {
                toastr.success(data.message);
            }
            if (typeof closePayrollModal === 'function') {
                closePayrollModal();
            }
            setTimeout(() => location.reload(), 1000);
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
}

// Initialize calculations on page load
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to all select dropdowns that affect calculations
    const leaveDeductionSelect = document.getElementById('leave_deduction');
    if (leaveDeductionSelect) {
        leaveDeductionSelect.addEventListener('change', calculateComprehensiveNetSalary);
    }
    
    const totalWorkingDaysSelect = document.getElementById('total_working_days');
    if (totalWorkingDaysSelect) {
        totalWorkingDaysSelect.addEventListener('change', calculateComprehensiveNetSalary);
    }
});
</script>
