@extends('layouts.macos')
@section('page_title', 'Profile')

@section('content')
  <div style="padding:20px 30px">
    <!-- Employee Info Row -->
    <div style="display:flex;align-items:center;gap:20px;padding:16px 0">
      <div style="display:flex;align-items:center;gap:12px;background:#f8f9fa;padding:8px 12px;border-radius:8px">
        <span style="font-size:12px;color:#6b7280;font-weight:600">Employee ID</span>
        <span style="font-size:12px;color:#2d3748;font-weight:700">#Chitri_0024</span>
      </div>
      <div style="width:60px;height:60px;border-radius:50%;overflow:hidden;background:#fbbf24">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face"
          style="width:100%;height:100%;object-fit:cover" alt="Dipesh Vasoya">
      </div>
      <div style="flex:1">
        <h2 style="font-size:18px;font-weight:700;color:#2d3748;margin:0 0 2px 0">Dipesh Vasoya</h2>
        <p style="color:#718096;margin:0;font-size:13px">UI/UX Designer</p>
      </div>
      <div
        style="display:flex;align-items:center;gap:6px;background:#e8f7ef;color:#0ea05d;font-weight:600;font-size:12px;padding:6px 12px;border-radius:12px">
        <div style="width:8px;height:8px;background:#0ea05d;border-radius:50%"></div>
        Active
      </div>
      <div style="display:flex;align-items:center;gap:8px;color:#718096;font-size:13px">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
          <path
            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
        </svg>
        +91 7359442073
      </div>
      <div style="display:flex;align-items:center;gap:8px;color:#718096;font-size:13px">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
          <path
            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
        </svg>
        dipeshvasoya22@gmail.com
      </div>
    </div>
  </div>

  <!-- Tabs Section -->
  <div style="background:white;border-radius:20px;box-shadow:0 2px 8px rgba(0,0,0,0.08);border:1px solid #e5e7eb">
    <!-- Tab Navigation -->
    <div style="display:flex;border-bottom:1px solid #e5e7eb;padding:0 24px">
      <button class="tab-btn active" onclick="switchTab('personal')"
        style="display:flex;align-items:center;gap:8px;padding:16px 20px;border:none;background:none;color:#0ea5e9;border-bottom:2px solid #0ea5e9;font-weight:600;cursor:pointer">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path
            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
        </svg>
        Personal Information
      </button>
      <button class="tab-btn" onclick="switchTab('payroll')"
        style="display:flex;align-items:center;gap:8px;padding:16px 20px;border:none;background:none;color:#718096;border-bottom:2px solid transparent;font-weight:600;cursor:pointer">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path
            d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" />
        </svg>
        Payroll
      </button>
      <button class="tab-btn" onclick="switchTab('attendance')"
        style="display:flex;align-items:center;gap:8px;padding:16px 20px;border:none;background:none;color:#718096;border-bottom:2px solid transparent;font-weight:600;cursor:pointer">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path
            d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" />
        </svg>
        Attendance Management
      </button>
      <button class="tab-btn" onclick="switchTab('documents')"
        style="display:flex;align-items:center;gap:8px;padding:16px 20px;border:none;background:none;color:#718096;border-bottom:2px solid transparent;font-weight:600;cursor:pointer">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
        </svg>
        Documents
      </button>
      <button class="tab-btn" onclick="switchTab('bank')"
        style="display:flex;align-items:center;gap:8px;padding:16px 20px;border:none;background:none;color:#718096;border-bottom:2px solid transparent;font-weight:600;cursor:pointer">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path d="M11.5,1L2,6V8H21V6M16,10V17H19V19H5V17H8V10H10V17H14V10" />
        </svg>
        Bank Details
      </button>
    </div>

    <!-- Tab Content -->
    <div id="personal" class="tab-content active" style="padding:30px">
      <div style="display:flex;gap:30px">
        <!-- Left Column - Profile Image -->
        <div style="flex:0 0 200px">
          <div style="width:200px;height:200px;border-radius:50%;overflow:hidden;background:#fbbf24;margin-bottom:20px">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face"
              style="width:100%;height:100%;object-fit:cover" alt="Dipesh Vasoya">
          </div>
        </div>

        <!-- Right Column - Form -->
        <div style="flex:1">
          <div class="hrp-compact">
            <form style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
              <!-- Full Name -->
              <div>
                <label class="hrp-label">Full Name</label>
                <input type="text" value="Vasoya Dipeshkumar Narendrabhai" class="hrp-input Rectangle-29">
              </div>

              <!-- Gender -->
              <div>
                <label class="hrp-label">Gender :</label>
                <div style="display:flex;gap:20px;align-items:center;margin-top:8px">
                  <label
                    style="display:flex;align-items:center;gap:8px;cursor:pointer;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif">
                    <input type="radio" name="gender" value="male" checked style="margin:0;accent-color:#374151">
                    <span style="color:#374151;font-weight:500">Male</span>
                    <div style="width:8px;height:8px;background:#374151;border-radius:50%;margin-left:4px"></div>
                  </label>
                  <label
                    style="display:flex;align-items:center;gap:8px;cursor:pointer;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif">
                    <input type="radio" name="gender" value="female" style="margin:0;accent-color:#9ca3af">
                    <span style="color:#9ca3af;font-weight:500">Female</span>
                  </label>
                </div>
              </div>

              <!-- Date of Birth -->
              <div>
                <label class="hrp-label">Date of Birth :</label>
                <input type="text" value="04/04/2000" class="hrp-input Rectangle-29">
              </div>

              <!-- Mobile No -->
              <div>
                <label class="hrp-label">Mobile No:</label>
                <input type="text" value="+91 9729724869" class="hrp-input Rectangle-29">
              </div>

              <!-- Marital Status -->
              <div>
                <label class="hrp-label">Marital Status :</label>
                <select class="Rectangle-29 Rectangle-29-select">
                  <option>Married</option>
                  <option>Single</option>
                </select>
              </div>

              <!-- Email ID -->
              <div>
                <label class="hrp-label">Email ID :</label>
                <input type="email" value="dipeshvasoya22@gmail.com" class="hrp-input Rectangle-29">
              </div>

              <!-- Address -->
              <div style="grid-column:1/-1">
                <label class="hrp-label">Address:</label>
                <textarea placeholder="Enter Your Address" class="Rectangle-29-textarea"></textarea>
              </div>

              <!-- Aadhaar Card Number -->
              <div>
                <label class="hrp-label">Aadhaar Card Number :</label>
                <input type="text" placeholder="XXXX XXXX XXXX" class="hrp-input Rectangle-29">
              </div>

              <!-- PAN Number -->
              <div>
                <label class="hrp-label">PAN Number :</label>
                <input type="text" placeholder="XXXXX0000X" class="hrp-input Rectangle-29">
              </div>

              <!-- Highest Qualification -->
              <div>
                <label class="hrp-label">Highest Qualification</label>
                <input type="text" placeholder="Enter your Highest Qualification" class="hrp-input Rectangle-29">
              </div>

              <!-- Year of Passing -->
              <div>
                <label class="hrp-label">Year of Passing</label>
                <input type="text" placeholder="Passing Year" class="hrp-input Rectangle-29">
              </div>

              <!-- Previous Company Name -->
              <div>
                <label class="hrp-label">Previous Company Name :</label>
                <input type="text" placeholder="Enter your Last Company Name" class="hrp-input Rectangle-29">
              </div>

              <!-- Previous Designation -->
              <div>
                <label class="hrp-label">Previous Designation :</label>
                <input type="text" placeholder="Enter your Last Designation" class="hrp-input Rectangle-29">
              </div>

              <!-- Duration -->
              <div>
                <label class="hrp-label">Duration :</label>
                <input type="text" placeholder="Add Time Duration" class="hrp-input Rectangle-29">
              </div>

              <!-- Reason for Leaving -->
              <div>
                <label class="hrp-label">Reason for Leaving</label>
                <textarea placeholder="Enter Reason for Leaving" class="Rectangle-29-textarea"></textarea>
              </div>

              <!-- Save Button -->
              <div style="grid-column:1/-1;margin-top:20px">
                <button type="submit"
                  style="background:#10b981;color:white;padding:12px 24px;border:none;border-radius:8px;font-weight:600;cursor:pointer">
                  SAVE
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Other Tab Contents (Hidden) -->
   <!-- Payroll Table Section -->
<div style="background:white;padding:0;margin:0">
  <!-- Payroll Data Table -->
  <div style="overflow-x:auto">
    <table style="width:100%;border-collapse:collapse;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif">
      <thead>
        <tr style="background:#f8f9fa;border-bottom:1px solid #e5e7eb">
          <th style="padding:16px 12px;text-align:left;font-weight:600;color:#374151;font-size:14px;border-right:1px solid #e5e7eb">Action</th>
          <th style="padding:16px 12px;text-align:left;font-weight:600;color:#374151;font-size:14px;border-right:1px solid #e5e7eb">Serial No</th>
          <th style="padding:16px 12px;text-align:left;font-weight:600;color:#374151;font-size:14px;border-right:1px solid #e5e7eb">Unique No</th>
          <th style="padding:16px 12px;text-align:left;font-weight:600;color:#374151;font-size:14px;border-right:1px solid #e5e7eb">Salary Month</th>
          <th style="padding:16px 12px;text-align:left;font-weight:600;color:#374151;font-size:14px;border-right:1px solid #e5e7eb">Format Type</th>
          <th style="padding:16px 12px;text-align:left;font-weight:600;color:#374151;font-size:14px;border-right:1px solid #e5e7eb">Payment Date</th>
          <th style="padding:16px 12px;text-align:left;font-weight:600;color:#374151;font-size:14px">Payment Amount</th>
        </tr>
      </thead>
      <tbody>
        <!-- Row 1 -->
        <tr style="border-bottom:1px solid #f3f4f6">
          <td style="padding:16px 12px;border-right:1px solid #e5e7eb">
            <div style="width:24px;height:24px;background:#3b82f6;border-radius:4px;display:flex;align-items:center;justify-content:center">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="white">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
              </svg>
            </div>
          </td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">1</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">CMS/LEAD/0022</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">OCT - 2025</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">Salary</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">30-10-2025</td>
          <td style="padding:16px 12px;color:#374151;font-weight:600;font-size:14px">₹ 11,000</td>
        </tr>
        
        <!-- Row 2 -->
        <tr style="border-bottom:1px solid #f3f4f6">
          <td style="padding:16px 12px;border-right:1px solid #e5e7eb">
            <div style="width:24px;height:24px;background:#3b82f6;border-radius:4px;display:flex;align-items:center;justify-content:center">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="white">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
              </svg>
            </div>
          </td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">2</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">CMS/LEAD/0023</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">Salary (OCT-25)</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">Salary</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">14-10-2025</td>
          <td style="padding:16px 12px;color:#374151;font-weight:600;font-size:14px">₹ 15,000</td>
        </tr>
        
        <!-- Row 3 -->
        <tr style="border-bottom:1px solid #f3f4f6">
          <td style="padding:16px 12px;border-right:1px solid #e5e7eb">
            <div style="width:24px;height:24px;background:#3b82f6;border-radius:4px;display:flex;align-items:center;justify-content:center">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="white">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
              </svg>
            </div>
          </td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">3</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">CMS/LEAD/0024</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">Other</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">Salary</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">29-09-2025</td>
          <td style="padding:16px 12px;color:#374151;font-weight:600;font-size:14px">₹ 20,000</td>
        </tr>
        
        <!-- Row 4 -->
        <tr style="border-bottom:1px solid #f3f4f6">
          <td style="padding:16px 12px;border-right:1px solid #e5e7eb">
            <div style="width:24px;height:24px;background:#3b82f6;border-radius:4px;display:flex;align-items:center;justify-content:center">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="white">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
              </svg>
            </div>
          </td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">4</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">CMS/LEAD/0025</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">Salary (JUN-25)</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">Salary</td>
          <td style="padding:16px 12px;color:#374151;font-weight:500;font-size:14px;border-right:1px solid #e5e7eb">28-08-2025</td>
          <td style="padding:16px 12px;color:#374151;font-weight:600;font-size:14px">₹ 12,000</td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <!-- Pagination Section -->
  <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 0;border-top:1px solid #e5e7eb;margin-top:20px">
    <!-- Left side - Entries info -->
    <div style="display:flex;align-items:center;gap:8px;color:#6b7280;font-size:14px">
      <span>Entries</span>
      <select style="padding:4px 8px;border:1px solid #d1d5db;border-radius:4px;background:white;color:#374151;font-size:14px">
        <option>25</option>
        <option>50</option>
        <option>100</option>
      </select>
    </div>
    
    <!-- Right side - Pagination -->
    <div style="display:flex;align-items:center;gap:8px">
      <button style="padding:8px 12px;border:1px solid #d1d5db;background:white;color:#6b7280;border-radius:4px;cursor:pointer;font-size:14px">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
        </svg>
      </button>
      
      <button style="padding:8px 12px;border:1px solid #ef4444;background:#ef4444;color:white;border-radius:4px;font-weight:600;font-size:14px">01</button>
      <button style="padding:8px 12px;border:1px solid #d1d5db;background:white;color:#6b7280;border-radius:4px;cursor:pointer;font-size:14px">02</button>
      <button style="padding:8px 12px;border:1px solid #d1d5db;background:white;color:#6b7280;border-radius:4px;cursor:pointer;font-size:14px">03</button>
      <button style="padding:8px 12px;border:1px solid #d1d5db;background:white;color:#6b7280;border-radius:4px;cursor:pointer;font-size:14px">04</button>
      <button style="padding:8px 12px;border:1px solid #d1d5db;background:white;color:#6b7280;border-radius:4px;cursor:pointer;font-size:14px">05</button>
      <span style="color:#6b7280;font-size:14px">...</span>
      <button style="padding:8px 12px;border:1px solid #d1d5db;background:white;color:#6b7280;border-radius:4px;cursor:pointer;font-size:14px">20</button>
      
      <button style="padding:8px 12px;border:1px solid #d1d5db;background:white;color:#6b7280;border-radius:4px;cursor:pointer;font-size:14px">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
        </svg>
      </button>
    </div>
  </div>
</div>

  <style>
    /* Import system fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    /* Tab styling */
    .tab-btn:hover {
      color: #0ea5e9 !important;
      border-bottom-color: #0ea5e9 !important;
    }

    .tab-btn.active {
      color: #0ea5e9 !important;
      border-bottom-color: #0ea5e9 !important;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* Form input focus states */
    input:focus,
    select:focus,
    textarea:focus {
      border-color: #3b82f6 !important;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }

    /* Placeholder styling */
    input::placeholder,
    textarea::placeholder {
      color: #9ca3af !important;
      font-weight: 400;
    }

    /* Radio button styling */
    input[type="radio"] {
      width: 16px;
      height: 16px;
      border: 2px solid #d1d5db;
      border-radius: 50%;
      appearance: none;
      background: white;
      cursor: pointer;
      position: relative;
    }

    input[type="radio"]:checked {
      border-color: #374151;
      background: #374151;
    }

    input[type="radio"]:checked::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: white;
    }

    /* Select dropdown arrow */
    select {
      cursor: pointer;
    }

    /* Save button styling */
    button[type="submit"] {
      background: #10b981 !important;
      color: white !important;
      padding: 12px 24px !important;
      border: none !important;
      border-radius: 8px !important;
      font-weight: 600 !important;
      cursor: pointer !important;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
      transition: background-color 0.2s !important;
    }

    button[type="submit"]:hover {
      background: #059669 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .tab-content form {
        grid-template-columns: 1fr !important;
      }

      input,
      select,
      textarea {
        padding: 12px 16px !important;
      }
    }

    /* Typography consistency */
    * {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    /* HRP Input Classes - Rectangle-29 */
    .hrp-input.Rectangle-29 {
      width: 100%;
      padding: 14px 18px;
      border: 1px solid #d1d5db;
      border-radius: 25px;
      font-size: 14px;
      background: #ffffff;
      color: #374151;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      outline: none;
      transition: border-color 0.2s;
      box-shadow: inset 0 2px 3px rgba(0, 0, 0, .2), 0 1px 0 #fff;
    }

    .hrp-input.Rectangle-29:focus {
      border-color: #3b82f6;
      box-shadow: inset 0 2px 3px rgba(0, 0, 0, .2), 0 1px 0 #fff, 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .hrp-input.Rectangle-29::placeholder {
      color: #9ca3af;
      font-weight: 400;
    }

    .Rectangle-29-select {
      width: 100%;
      padding: 14px 18px;
      border: 1px solid #d1d5db;
      border-radius: 25px;
      font-size: 14px;
      background: #ffffff;
      color: #374151;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      outline: none;
      appearance: none;
      background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23666" d="M2 0L0 2h4zm0 5L0 3h4z"/></svg>');
      background-repeat: no-repeat;
      background-position: right 18px center;
      background-size: 12px;
      cursor: pointer;
      transition: border-color 0.2s;
      box-shadow: inset 0 2px 3px rgba(0, 0, 0, .2), 0 1px 0 #fff;
    }

    .Rectangle-29-select:focus {
      border-color: #3b82f6;
      box-shadow: inset 0 2px 3px rgba(0, 0, 0, .2), 0 1px 0 #fff, 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .Rectangle-29-textarea {
      width: 100%;
      padding: 14px 18px;
      border: 1px solid #d1d5db;
      border-radius: 20px;
      font-size: 14px;
      background: #ffffff;
      color: #374151;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      outline: none;
      min-height: 80px;
      resize: vertical;
      transition: border-color 0.2s;
      box-shadow: inset 0 2px 3px rgba(0, 0, 0, .2), 0 1px 0 #fff;
    }

    .Rectangle-29-textarea:focus {
      border-color: #3b82f6;
      box-shadow: inset 0 2px 3px rgba(0, 0, 0, .2), 0 1px 0 #fff, 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .hrp-label {
      display: block;
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
  </style>

  <script>
    function switchTab(tabName) {
      // Hide all tab contents
      document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
        tab.style.display = 'none';
      });

      // Remove active class from all tab buttons
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.style.color = '#718096';
        btn.style.borderBottomColor = 'transparent';
      });

      // Show selected tab content
      const selectedTab = document.getElementById(tabName);
      if (selectedTab) {
        selectedTab.classList.add('active');
        selectedTab.style.display = 'block';
      }

      // Activate selected tab button
      const selectedBtn = document.querySelector(`[onclick="switchTab('${tabName}')"]`);
      if (selectedBtn) {
        selectedBtn.classList.add('active');
        selectedBtn.style.color = '#0ea5e9';
        selectedBtn.style.borderBottomColor = '#0ea5e9';
      }
    }
  </script>
@endsection