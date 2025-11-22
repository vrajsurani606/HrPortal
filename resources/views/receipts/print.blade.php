<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - {{ $receipt->unique_code }}</title>
    <style>
        :root {
            --primary-color: #456DB5;
            --border-color: #ddd;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            padding: 15px;
            margin: 0;
            line-height: 1.4;
        }
        
        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            padding: 25px 35px;
            border: 2px solid var(--border-color);
            position: relative;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        /* Background Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.03;
            z-index: 0;
            pointer-events: none;
        }
        
        .watermark img {
            width: 600px;
            height: auto;
        }
        
        .content {
            position: relative;
            z-index: 1;
        }
        
        /* Logo Section */
        .logo-section {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .logo-section img {
            max-width: 160px;
            height: auto;
        }
        
        /* Header Info */
        .header-info {
            text-align: right;
            margin-bottom: 15px;
            font-size: 11px;
            color: #555;
            line-height: 1.5;
        }
        
        .header-info p {
            margin: 1px 0;
        }
        
        .header-info strong {
            color: #333;
            font-weight: 600;
        }
        
        /* Title */
        .receipt-title {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
        }
        
        .receipt-title h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        
        /* From and Bill To Section */
        .parties-section {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }
        
        .party-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
        }
        
        .party-column:first-child {
            padding-left: 0;
        }
        
        .party-column:last-child {
            padding-right: 0;
        }
        
        .party-heading {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.8px;
        }
        
        .party-details {
            font-size: 11px;
            line-height: 1.6;
            color: #555;
        }
        
        .party-details p {
            margin: 2px 0;
        }
        
        .party-details strong {
            color: #222;
            font-weight: 600;
        }
        
        /* Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .items-table thead {
            background: var(--primary-color);
            color: white;
        }
        
        .items-table th {
            padding: 10px 8px;
            text-align: left;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
            border: 1px solid var(--primary-color);
            letter-spacing: 0.5px;
        }
        
        .items-table td {
            padding: 8px;
            border: 1px solid #e0e0e0;
            font-size: 11px;
            color: #444;
        }
        
        .items-table tbody tr:nth-child(even) {
            background: #fafafa;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        /* Summary Section */
        .summary-section {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }
        
        .summary-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }
        
        .summary-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        /* Bank Details */
        .bank-details-heading {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        
        .bank-details-text {
            font-size: 10px;
            line-height: 1.5;
            color: #555;
        }
        
        .bank-details-text p {
            margin: 2px 0;
        }
        
        .bank-details-text strong {
            color: #333;
            font-weight: 600;
        }
        
        /* Amount Box */
        .amount-box {
            background: #E8F0FC;
            border: 1px solid #C5D9F2;
            border-radius: 4px;
            padding: 12px 15px;
            display: table;
            width: 100%;
        }
        
        .amount-box .label {
            display: table-cell;
            font-size: 14px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .amount-box .amount {
            display: table-cell;
            text-align: right;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        /* Signatures */
        .signatures-section {
            display: table;
            width: 100%;
            margin-top: 30px;
        }
        
        .signature-box {
            display: table-cell;
            width: 50%;
        }
        
        .signature-box:last-child {
            text-align: right;
        }
        
        .signature-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .signature-line {
            height: 50px;
            border-bottom: 2px solid #ddd;
            margin-top: 30px;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }
            
            .page {
                margin: 0;
                padding: 10mm 8mm;
                width: 100%;
                max-width: 100%;
                min-height: 297mm;
                border: none;
                box-shadow: none;
            }
            
            @page {
                size: A4;
                margin: 0;
            }
            
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Background Watermark -->
        <div class="watermark">
            <img src="{{ asset('full_logo.jpeg') }}" alt="Watermark">
        </div>
        
        <div class="content">
            <!-- Logo -->
            <div class="logo-section">
                <img src="{{ asset('full_logo.jpeg') }}" alt="Enlargesoft Logo">
            </div>
            
            <!-- Header Info -->
            <div class="header-info">
                <p><strong>Date:</strong> {{ $receipt->receipt_date ? $receipt->receipt_date->format('d-m-Y') : date('d-m-Y') }}</p>
                <p><strong>Receipt No.:</strong> {{ $receipt->unique_code }}</p>
            </div>
            
            <!-- Title -->
            <div class="receipt-title">
                <h1>Receipt</h1>
            </div>
            
            <!-- From and Bill To -->
            <div class="parties-section">
                <div class="party-column">
                    <div class="party-heading">From</div>
                    <div class="party-details">
                        <p><strong>CHITRI ENLARGE SOFT IT HUB PVT. LTD.</strong></p>
                        <p>401/B, RISE ON PLAZA, SARKHEJ JAKAT NAKA,</p>
                        <p>SURAT, 390006.</p>
                        <p>GST. NO.: 24AAMCC4413E1Z1</p>
                        <p>Mo. (+91) 72763 23999</p>
                    </div>
                </div>
                
                <div class="party-column">
                    <div class="party-heading">Bill To</div>
                    <div class="party-details">
                        <p><strong>{{ strtoupper($receipt->company_name) }}</strong></p>
                    </div>
                </div>
            </div>
            
            <!-- Transaction Details Table -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th>DESCRIPTION</th>
                        <th class="text-center" style="width: 150px;">TRANSACTION CODE</th>
                        <th class="text-center" style="width: 150px;">PAYMENT TYPE</th>
                        <th class="text-right" style="width: 150px;">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>{{ strtoupper($receipt->payment_type ?? 'PAYMENT') }}</strong></td>
                        <td class="text-center">{{ $receipt->trans_code ?? '-' }}</td>
                        <td class="text-center">{{ $receipt->payment_type ?? '-' }}</td>
                        <td class="text-right"><strong>₹{{ number_format($receipt->received_amount, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Summary Section -->
            <div class="summary-section">
                <!-- Bank Details -->
                <div class="summary-left">
                    <div class="bank-details-heading">Bank Details</div>
                    <div class="bank-details-text">
                        <p><strong>Account No:</strong> 001161900016923</p>
                        <p><strong>IFSC Code:</strong> YESB0000011</p>
                        <p><strong>Branch:</strong> YES BANK LTD., GR FLOOR,</p>
                        <p>MANGALDEEP, RING ROAD,</p>
                        <p>NEAR MAHAVIR HOSPITAL, NEAR RTO,</p>
                        <p>SURAT 395001.</p>
                    </div>
                </div>
                
                <!-- Amount Received -->
                <div class="summary-right">
                    <div class="amount-box">
                        <div class="label">Amount Received</div>
                        <div class="amount">₹{{ number_format($receipt->received_amount, 2) }} /-</div>
                    </div>
                </div>
            </div>
            
            <!-- Signatures -->
            <div class="signatures-section">
                <div class="signature-box">
                    <div class="signature-label">Company Signature</div>
                    <div class="signature-line"></div>
                </div>
                <div class="signature-box">
                    <div class="signature-label">Client Signature</div>
                    <div class="signature-line"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
