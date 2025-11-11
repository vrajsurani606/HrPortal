@extends('layouts.macos')
@section('page_title', 'Company Details')
@section('content')
  <div class="Rectangle-30 hrp-compact">
    <!-- Top two-column details -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
      <div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
        <h3 style="font-weight: 600; margin-bottom: 15px; color: #333;">Company Details</h3>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Unique Code</span><span style="color: #333;">: CEI/COM/0015</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Name</span><span style="color: #333;">: Manglam Consultancy Services</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Address</span><span style="color: #333;">: 9th Main Rd, Sector 6, HSR Layout</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Gst No</span><span style="color: #333;">: 24ABAFM0105D1Z8</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Pan No</span><span style="color: #333;">: ---</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Other</span><span style="color: #333;">: ---</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Type</span><span style="color: #333;">: AGRICULTURE AND ALLIED INDUS..</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Email</span><span style="color: #333;">: Mcsvdr@Gmail.Com</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Password</span><span style="color: #333;">: 123456</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Employee Email</span><span style="color: #333;">: Mcsvdrqueries@Gmail.Com</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company Employee Password</span><span style="color: #333;">: 123456</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Company City</span><span style="color: #333;">: Baroda</span></div>
        </div>
      </div>
      <div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
        <h3 style="font-weight: 600; margin-bottom: 15px; color: #333;">Person's Details</h3>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Name</span><span style="color: #333;">: Pratikbhai Desai</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Number</span><span style="color: #333;">: 9824042821</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Position</span><span style="color: #333;">: Owner</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Name</span><span style="color: #333;">: Undefined</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Number</span><span style="color: #333;">: Undefined</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Position</span><span style="color: #333;">: Undefined</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Name</span><span style="color: #333;">: Undefined</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Number</span><span style="color: #333;">: Undefined</span></div>
          <div style="display: flex; justify-content: space-between; padding: 4px 0;"><span style="color: #666;">Person Position</span><span style="color: #333;">: <br /><<b>Warning</b>: Undefined Array Key</span></div>
        </div>
      </div>
    </div>

    <!-- Documents Row -->
    <div style="margin-bottom: 30px;">
      <div style="font-weight: 600; margin-bottom: 15px; color: #333;">All Documents :</div>
      <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px;">
        <div style="background: white; border-radius: 8px; padding: 15px; border: 1px solid #e5e7eb;">
          <div style="font-size: 14px; margin-bottom: 10px; color: #666;">Company Logo</div>
          <div style="border: 1px solid #e5e7eb; border-radius: 6px; display: flex; align-items: center; justify-content: center; height: 120px; background: #f9fafb; position: relative;">
            <img src="{{ asset('Doc_icon/Dashboard.png') }}" alt="logo" style="height: 60px;">
            <div style="position: absolute; top: 8px; right: 8px; background: #000; border-radius: 4px; padding: 6px; cursor: pointer;">
              <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
            </div>
          </div>
        </div>
        <div style="background: white; border-radius: 8px; padding: 15px; border: 1px solid #e5e7eb;">
          <div style="font-size: 14px; margin-bottom: 10px; color: #666;">Sop Upload</div>
          <div style="border: 1px solid #e5e7eb; border-radius: 6px; display: flex; align-items: center; justify-content: center; height: 120px; background: #f9fafb; position: relative;">
            <img src="{{ asset('Doc_icon/Attendance Management.png') }}" alt="doc" style="height: 60px;">
            <div style="position: absolute; top: 8px; right: 8px; background: #000; border-radius: 4px; padding: 6px; cursor: pointer;">
              <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
            </div>
          </div>
        </div>
        <div style="background: white; border-radius: 8px; padding: 15px; border: 1px solid #e5e7eb;">
          <div style="font-size: 14px; margin-bottom: 10px; color: #666;">Leaser Report ( Non-GST )</div>
          <div style="border: 1px solid #e5e7eb; border-radius: 6px; display: flex; align-items: center; justify-content: center; height: 120px; background: #f9fafb; position: relative;">
            <img src="{{ asset('Doc_icon/Company Information.png') }}" alt="doc" style="height: 60px;">
            <div style="position: absolute; top: 8px; right: 8px; background: #000; border-radius: 4px; padding: 6px; cursor: pointer;">
              <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
            </div>
          </div>
        </div>
        <div style="background: white; border-radius: 8px; padding: 15px; border: 1px solid #e5e7eb;">
          <div style="font-size: 14px; margin-bottom: 10px; color: #666;">Leaser Report ( GST 18% )</div>
          <div style="border: 1px solid #e5e7eb; border-radius: 6px; display: flex; align-items: center; justify-content: center; height: 120px; background: #f9fafb; position: relative;">
            <img src="{{ asset('Doc_icon/Dashboard.png') }}" alt="doc" style="height: 60px;">
            <div style="position: absolute; top: 8px; right: 8px; background: #000; border-radius: 4px; padding: 6px; cursor: pointer;">
              <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
            </div>
          </div>
        </div>
        <div style="background: white; border-radius: 8px; padding: 15px; border: 1px solid #e5e7eb;">
          <div style="font-size: 14px; margin-bottom: 10px; color: #666;">&nbsp;</div>
          <div style="border: 2px dashed #d1d5db; border-radius: 6px; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 120px; background: #4b5563; cursor: pointer;" onclick="document.getElementById('fileUpload').click()">
            <svg width="24" height="24" fill="white" viewBox="0 0 24 24" style="margin-bottom: 8px;"><path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/><path d="M12,11L16,15H13V19H11V15H8L12,11Z"/></svg>
            <span style="color: white; font-size: 14px; font-weight: 600;">Upload</span>
            <input type="file" id="fileUpload" style="display: none;" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
          </div>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div style="margin-bottom: 20px;">
      <div style="display: flex; gap: 8px; overflow-x: auto; padding-bottom: 10px; border-bottom: 1px solid #e5e7eb;">
        <button style="background: #000; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: pointer;" data-tab="quotation">🗂️ Quotation List</button>
        <button style="background: #f3f4f6; color: #374151; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: pointer;" data-tab="template">📋 Template List</button>
        <button style="background: #f3f4f6; color: #374151; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: pointer;" data-tab="proforma">📄 Proforma Mana.</button>
        <button style="background: #f3f4f6; color: #6b7280; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: not-allowed;" data-tab="invoice" disabled>🧾 Invoice Mana.</button>
        <button style="background: #f3f4f6; color: #6b7280; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: not-allowed;" data-tab="receipt" disabled>🧾 The Receipt</button>
        <button style="background: #f3f4f6; color: #6b7280; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: not-allowed;" data-tab="ticket" disabled>🎫 Ticket</button>
      </div>

      <!-- Tab contents -->
      <div id="tab-quotation" style="margin-top: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
          <div style="display: flex; align-items: center; gap: 10px;">
            <input type="text" placeholder="Search here..." style="padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; width: 200px;">
          </div>
          <div style="display: flex; gap: 10px;">
            <button style="background: #22c55e; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 6px;" onclick="window.location.href='/quotations/create'">
              <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
              + Add
            </button>
            <button style="background: #6b7280; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; cursor: pointer; display: flex; align-items: center; gap: 6px;" onclick="printQuotationList()">
              <svg width="16" height="16" fill="white" viewBox="0 0 24 24"><path d="M18 3H6v4h12V3zm1 5H5c-1.1 0-2 .9-2 2v6h4v4h10v-4h4v-6c0-1.1-.9-2-2-2zm-1 11H8v-4h10v4zm-8-2v-2h6v2H10z"/></svg>
              Print
            </button>
          </div>
        </div>
        <div style="overflow-x: auto; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
          <table style="width: 100%; border-collapse: collapse;">
            <thead>
              <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Action</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Serial No</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Unique No</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Quotation Amount</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">AMC Start Date</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">AMC Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 12px;">
                  <div style="display: flex; gap: 8px; align-items: center;">
                    <div style="width: 20px; height: 20px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                      <span style="color: white; font-size: 12px;">✓</span>
                    </div>
                    <svg width="16" height="16" fill="#3b82f6" viewBox="0 0 24 24" style="cursor: pointer;" title="Edit"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                    <svg width="16" height="16" fill="#6b7280" viewBox="0 0 24 24" style="cursor: pointer;" title="Print" onclick="printSingleQuotation(1)"><path d="M18 3H6v4h12V3zm1 5H5c-1.1 0-2 .9-2 2v6h4v4h10v-4h4v-6c0-1.1-.9-2-2-2zm-1 11H8v-4h10v4zm-8-2v-2h6v2H10z"/></svg>
                  </div>
                </td>
                <td style="padding: 12px; color: #374151;">1</td>
                <td style="padding: 12px; color: #374151;">CEI/QUAT/0001</td>
                <td style="padding: 12px; color: #374151;">3,80,000.00</td>
                <td style="padding: 12px; color: #374151;">30-10-2025</td>
                <td style="padding: 12px; color: #374151;">00.00</td>
              </tr>
              <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 12px;">
                  <div style="display: flex; gap: 8px; align-items: center;">
                    <div style="width: 20px; height: 20px; background: #fbbf24; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                      <span style="color: white; font-size: 12px;">⚠</span>
                    </div>
                    <svg width="16" height="16" fill="#3b82f6" viewBox="0 0 24 24" style="cursor: pointer;" title="Edit"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                    <svg width="16" height="16" fill="#6b7280" viewBox="0 0 24 24" style="cursor: pointer;" title="Print" onclick="printSingleQuotation(2)"><path d="M18 3H6v4h12V3zm1 5H5c-1.1 0-2 .9-2 2v6h4v4h10v-4h4v-6c0-1.1-.9-2-2-2zm-1 11H8v-4h10v4zm-8-2v-2h6v2H10z"/></svg>
                  </div>
                </td>
                <td style="padding: 12px; color: #374151;">2</td>
                <td style="padding: 12px; color: #374151;">CEI/QUAT/0002</td>
                <td style="padding: 12px; color: #374151;">1,50,000.00</td>
                <td style="padding: 12px; color: #374151;">14-10-2025</td>
                <td style="padding: 12px; color: #374151;">00.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Template List Tab -->
      <div id="tab-template" style="margin-top: 20px; display: none;">
        <div style="overflow-x: auto; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
          <table style="width: 100%; border-collapse: collapse;">
            <thead>
              <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Action</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Serial No</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Billing No</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Description</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Amount</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Completion Per</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Completion Term</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 12px;">
                  <div style="display: flex; gap: 8px; align-items: center;">
                    <div style="width: 20px; height: 20px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                      <span style="color: white; font-size: 12px;">✓</span>
                    </div>
                    <svg width="16" height="16" fill="#3b82f6" viewBox="0 0 24 24" style="cursor: pointer;"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                  </div>
                </td>
                <td style="padding: 12px; color: #374151;">1</td>
                <td style="padding: 12px; color: #374151;">CEI/QUAT/0001</td>
                <td style="padding: 12px; color: #374151;">XYZ, ABC</td>
                <td style="padding: 12px; color: #374151;">1,00,000</td>
                <td style="padding: 12px; color: #374151;">10</td>
                <td style="padding: 12px; color: #374151;">5,500</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Proforma Tab -->
      <div id="tab-proforma" style="margin-top: 20px; display: none;">
        <div style="overflow-x: auto; background: white; border-radius: 8px; border: 1px solid #e5e7eb;">
          <table style="width: 100%; border-collapse: collapse;">
            <thead>
              <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Serial No</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Is Invoice</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Invoice No.</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Billing No.</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Billing Date</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Template Desc.</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Grand Total</th>
                <th style="text-align: left; padding: 12px; font-weight: 600; color: #374151;">Total Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom: 1px solid #f3f4f6;">
                <td style="padding: 12px; color: #374151;">1</td>
                <td style="padding: 12px;">
                  <div style="width: 20px; height: 20px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <span style="color: white; font-size: 12px;">✓</span>
                  </div>
                </td>
                <td style="padding: 12px; color: #374151;">CEI/INV/001</td>
                <td style="padding: 12px; color: #374151;">CEI/QUAT/0001</td>
                <td style="padding: 12px; color: #374151;">25-09-2025</td>
                <td style="padding: 12px; color: #374151;">COMPLETION</td>
                <td style="padding: 12px; color: #374151;">85,000.00</td>
                <td style="padding: 12px; color: #374151;">1,00,300.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('breadcrumb')
  <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
  <span class="hrp-bc-sep">›</span>
  <span class="hrp-bc-current">Company Details</span>
@endsection

@push('scripts')
<script>
  document.querySelectorAll('[data-tab]').forEach(btn => {
    btn.addEventListener('click', () => {
      if (btn.hasAttribute('disabled')) return;
      const name = btn.getAttribute('data-tab');
      // toggle active button styles
      document.querySelectorAll('[data-tab]').forEach(b => {
        if (!b.hasAttribute('disabled')) {
          b.style.background = '#f3f4f6';
          b.style.color = '#374151';
        }
      });
      btn.style.background = '#000';
      btn.style.color = 'white';
      // toggle sections
      document.getElementById('tab-quotation').style.display = 'none';
      document.getElementById('tab-template').style.display = 'none';
      document.getElementById('tab-proforma').style.display = 'none';
      const map = { quotation: 'tab-quotation', template: 'tab-template', proforma: 'tab-proforma' };
      const target = map[name];
      if (target) document.getElementById(target).style.display = 'block';
    });
  });

  // File upload functionality
  document.getElementById('fileUpload').addEventListener('change', function(e) {
    const files = e.target.files;
    if (files.length > 0) {
      alert(`${files.length} file(s) selected for upload`);
      // Add your upload logic here
    }
  });

  // Print functionality
  window.printQuotationList = function() {
    const printContent = document.getElementById('tab-quotation').innerHTML;
    const originalContent = document.body.innerHTML;
    document.body.innerHTML = `
      <div style="padding: 20px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Quotation List</h2>
        ${printContent}
      </div>
    `;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload();
  };
</script>
@endpush
