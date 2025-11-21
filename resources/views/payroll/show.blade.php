<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Slip - {{ $payroll->employee->name }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: #fff;
            color: #000;
            font-size: 12px;
            line-height: 1.4;
        }
        
        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 15mm;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .header {
            border: 2px solid #000;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo {
            width: 70px;
            height: 70px;
            border: 1px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }
        
        .logo img {
            max-width: 100%;
            max-height: 100%;
        }
        
        .company-info {
            flex: 1;
            text-align: center;
            padding: 0 20px;
        }
        
        .company-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .company-address {
            font-size: 10px;
            line-height: 1.5;
        }
        
        .title {
            text-align: center;
            background: #000;
            color: white;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 15px;
        }
        
        .section {
            margin-bottom: 15px;
        }
        
        .section-title {
            background: #e0e0e0;
            padding: 6px 10px;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #000;
            text-transform: uppercase;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-table td {
            border: 1px solid #000;
            padding: 6px 10px;
            font-size: 11px;
        }
        
        .info-table td:nth-child(odd) {
            background: #f5f5f5;
            font-weight: bold;
            width: 25%;
        }
        
        .attendance-table th,
        .attendance-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            font-size: 11px;
        }
        
        .attendance-table th {
            background: #d0d0d0;
            font-weight: bold;
        }
        
        .salary-table th {
            background: #d0d0d0;
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        
        .salary-table td {
            border: 1px solid #000;
            padding: 6px 10px;
            font-size: 11px;
        }
        
        .salary-table td:last-child {
            text-align: right;
            font-weight: bold;
        }
        
        .total-row {
            background: #e8e8e8;
            font-weight: bold;
        }
        
        .net-row {
            background: #000;
            color: white;
            font-size: 13px;
            font-weight: bold;
        }
        
        .amount-words {
            border: 1px solid #000;
            padding: 10px;
            background: #f9f9f9;
            margin: 15px 0;
        }
        
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        
        .signature {
            text-align: center;
            width: 200px;
        }
        
        .sig-line {
            border-top: 1px solid #000;
            margin-bottom: 5px;
            margin-top: 50px;
        }
        
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #000;
        }
        
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #000;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            z-index: 1000;
        }
        
        @media print {
            body {
                background: white;
            }
            
            .page {
                box-shadow: none;
                margin: 0;
                padding: 10mm;
            }
            
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">🖨 PRINT</button>

    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="Company Logo" onerror="this.style.display='none'">
            </div>
            <div class="company-info">
                <div class="company-name">CHITRI ENLARGE SOFT IT HUB PVT. LTD.</div>
                <div class="company-address">
                    IT Solutions & Software Development Company<br>
                    Phone: +91 1234567890 | Email: hr@chitrienlarge.com | Website: www.chitrienlarge.com<br>
                    CIN: U72900GJ2024PTC123456 | GSTIN: 24XXXXX1234X1ZX
                </div>
            </div>
            <div style="width: 100px; text-align: right; font-size: 10px;">
                <strong>Slip Date:</strong><br>{{ now()->format('d-M-Y') }}<br>
                <strong>Slip No:</strong><br>PAY/{{ $payroll->year }}/{{ str_pad($payroll->id, 4, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <!-- Title -->
        <div class="title">SALARY SLIP</div>

        <!-- Employee Information -->
        <div class="section">
            <div class="section-title">Employee Information</div>
            <table class="info-table">
                <tr>
                    <td>Employee Name</td>
                    <td>{{ strtoupper($payroll->employee->name) }}</td>
                    <td>Employee Code</td>
                    <td>{{ $payroll->employee->code ?? 'EMP-' . str_pad($payroll->employee->id, 4, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td>Designation</td>
                    <td>{{ $payroll->employee->position ?? 'N/A' }}</td>
                    <td>Department</td>
                    <td>{{ $payroll->employee->department ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Date of Joining</td>
                    <td>{{ $payroll->employee->joining_date ? \Carbon\Carbon::parse($payroll->employee->joining_date)->format('d-M-Y') : 'N/A' }}</td>
                    <td>PAN Number</td>
                    <td>{{ $payroll->employee->pan_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Bank Name</td>
                    <td>{{ $payroll->employee->bank_name ?? 'N/A' }}</td>
                    <td>Bank Account No.</td>
                    <td>{{ $payroll->employee->bank_account ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>UAN Number</td>
                    <td>{{ $payroll->employee->uan_number ?? 'N/A' }}</td>
                    <td>PF Number</td>
                    <td>{{ $payroll->employee->pf_number ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>

        <!-- Pay Period & Attendance -->
        <div class="section">
            <div class="section-title">Pay Period & Attendance Details</div>
            <table class="info-table">
                <tr>
                    <td>Pay Period</td>
                    <td colspan="3"><strong>{{ strtoupper($payroll->month) }} {{ $payroll->year }}</strong></td>
                </tr>
                <tr>
                    <td>Payment Date</td>
                    <td>{{ $payroll->payment_date ? $payroll->payment_date->format('d-M-Y') : 'N/A' }}</td>
                    <td>Payment Method</td>
                    <td>{{ strtoupper($payroll->payment_method ?? 'BANK TRANSFER') }}</td>
                </tr>
            </table>
            
            @php
                $monthNumber = date('n', strtotime($payroll->month));
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $payroll->year);
                $leaveDays = \App\Models\Leave::where('employee_id', $payroll->employee_id)
                    ->where('status', 'approved')
                    ->whereYear('start_date', $payroll->year)
                    ->whereMonth('start_date', $monthNumber)
                    ->sum('total_days');
                $workingDays = $daysInMonth - $leaveDays;
                $perDaySalary = $payroll->basic_salary / $daysInMonth;
            @endphp
            
            <table class="attendance-table" style="margin-top: 10px;">
                <tr>
                    <th>Total Days in Month</th>
                    <th>Working Days</th>
                    <th>Leave Days</th>
                    <th>Paid Days</th>
                    <th>Per Day Salary</th>
                </tr>
                <tr>
                    <td>{{ $daysInMonth }}</td>
                    <td>{{ $workingDays }}</td>
                    <td style="color: #d00;">{{ $leaveDays }}</td>
                    <td>{{ $workingDays }}</td>
                    <td>₹ {{ number_format($perDaySalary, 2) }}</td>
                </tr>
            </table>
        </div>

        <!-- Salary Details -->
        <div class="section">
            <div class="section-title">Salary Details</div>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th style="width: 50%;">EARNINGS</th>
                        <th style="width: 25%; text-align: right;">AMOUNT (₹)</th>
                        <th style="width: 25%;">DEDUCTIONS</th>
                        <th style="text-align: right;">AMOUNT (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Basic Salary</td>
                        <td style="text-align: right;">{{ number_format($payroll->basic_salary, 2) }}</td>
                        <td>Leave Deduction ({{ $leaveDays }} days)</td>
                        <td style="text-align: right;">{{ number_format($payroll->deductions, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Allowances / HRA</td>
                        <td style="text-align: right;">{{ number_format($payroll->allowances, 2) }}</td>
                        <td>Professional Tax</td>
                        <td style="text-align: right;">{{ number_format($payroll->tax, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Bonuses / Incentives</td>
                        <td style="text-align: right;">{{ number_format($payroll->bonuses, 2) }}</td>
                        <td>Other Deductions</td>
                        <td style="text-align: right;">0.00</td>
                    </tr>
                    <tr>
                        <td>Special Allowance</td>
                        <td style="text-align: right;">0.00</td>
                        <td>Provident Fund (PF)</td>
                        <td style="text-align: right;">0.00</td>
                    </tr>
                    <tr>
                        <td>Overtime</td>
                        <td style="text-align: right;">0.00</td>
                        <td>ESI</td>
                        <td style="text-align: right;">0.00</td>
                    </tr>
                    <tr class="total-row">
                        <td>GROSS EARNINGS</td>
                        <td style="text-align: right;">₹ {{ number_format($payroll->basic_salary + $payroll->allowances + $payroll->bonuses, 2) }}</td>
                        <td>TOTAL DEDUCTIONS</td>
                        <td style="text-align: right;">₹ {{ number_format($payroll->deductions + $payroll->tax, 2) }}</td>
                    </tr>
                    <tr class="net-row">
                        <td colspan="3">NET SALARY (Take Home Salary)</td>
                        <td style="text-align: right;">₹ {{ number_format($payroll->net_salary, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Amount in Words -->
        @php
            $amount = floor($payroll->net_salary);
            $ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
            $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
            
            function convertToWords($num, $ones, $tens) {
                if ($num < 20) return $ones[$num];
                if ($num < 100) return $tens[intval($num / 10)] . ($num % 10 ? ' ' . $ones[$num % 10] : '');
                if ($num < 1000) return $ones[intval($num / 100)] . ' Hundred' . ($num % 100 ? ' ' . convertToWords($num % 100, $ones, $tens) : '');
                if ($num < 100000) return convertToWords(intval($num / 1000), $ones, $tens) . ' Thousand' . ($num % 1000 ? ' ' . convertToWords($num % 1000, $ones, $tens) : '');
                if ($num < 10000000) return convertToWords(intval($num / 100000), $ones, $tens) . ' Lakh' . ($num % 100000 ? ' ' . convertToWords($num % 100000, $ones, $tens) : '');
                return convertToWords(intval($num / 10000000), $ones, $tens) . ' Crore' . ($num % 10000000 ? ' ' . convertToWords($num % 10000000, $ones, $tens) : '');
            }
            
            $words = $amount > 0 ? convertToWords($amount, $ones, $tens) : 'Zero';
        @endphp
        <div class="amount-words">
            <strong>Net Salary in Words:</strong> {{ $words }} Rupees Only
        </div>

        @if($payroll->notes)
        <div style="border: 1px solid #000; padding: 8px; margin: 10px 0; background: #fffbeb;">
            <strong>Note:</strong> {{ $payroll->notes }}
        </div>
        @endif

        <!-- Signatures -->
        <div class="signatures">
            <div class="signature">
                <div class="sig-line"></div>
                <strong>Employee Signature</strong><br>
                <small>{{ $payroll->employee->name }}</small>
            </div>
            <div class="signature">
                <div class="sig-line"></div>
                <strong>HR Manager</strong><br>
                <small>Human Resources</small>
            </div>
            <div class="signature">
                <div class="sig-line"></div>
                <strong>Authorized Signatory</strong><br>
                <small>Finance Department</small>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <strong>Note:</strong> This is a computer-generated salary slip and does not require a physical signature.<br>
            For any queries regarding this salary slip, please contact the HR Department.<br>
            <strong>CHITRI ENLARGE SOFT IT HUB PVT. LTD.</strong> | Confidential Document<br>
            <small>Generated on {{ now()->format('d-M-Y h:i A') }}</small>
        </div>
    </div>
</body>
</html>
