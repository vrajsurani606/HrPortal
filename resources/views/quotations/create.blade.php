@extends('layouts.macos')
@section('page_title', 'Make Quotation')
@section('content')
  <div class="hrp-card">
  <div class="Rectangle-30 hrp-compact">
    <form method="POST" action="{{ route('quotations.store') }}"
      class="hrp-form grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5">
      @csrf
      <input type="hidden" name="inquiry_id" value="{{ $inquiry->id ?? 1 }}">

      <!-- Row 1 -->
      <div>
        <label class="hrp-label">Unique Code</label>
        <input class="Rectangle-29" name="unique_code" value="{{ $inquiry->unique_code ?? 'CMS/LEAD/OO22' }}" readonly>
      </div>
      <div>
        <label class="hrp-label">Quotation Title:</label>
        <input class="Rectangle-29" name="quotation_title" placeholder="Enter your Title">
      </div>
      <div>
        <label class="hrp-label">Quotation Date:</label>
        <input type="date" class="Rectangle-29" name="quotation_date" value="{{ date('Y-m-d') }}">
      </div>

      <!-- Row 2: four fields in 1 row with responsive spans (3/3/1/1) -->
      <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-8 gap-4 md:gap-5">
        <div class="md:col-span-3">
          <label class="hrp-label">Which Customer:</label>
          <select class="Rectangle-29-select" name="customer_type">
            <option>New Customer</option>
            <option>Existing Customer</option>
          </select>
        </div>
        <div class="md:col-span-3">
          <label class="hrp-label">Select Customer:</label>
          <select class="Rectangle-29-select" name="customer_id">
            <option>Select Customer</option>
          </select>
        </div>
        <div class="md:col-span-1">
          <label class="hrp-label">GST No:</label>
          <input class="Rectangle-29" name="gst_no" placeholder="Enter GST No">
        </div>
        <div class="md:col-span-1">
          <label class="hrp-label">PAN No:</label>
          <input class="Rectangle-29" name="pan_no" placeholder="Enter PAN No">
        </div>
      </div>
      <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5">
        <div class="md:col-span-2">
          <label class="hrp-label">Company Name:</label>
          <input class="Rectangle-29" name="company_name" value="{{ $inquiry->company_name ?? '' }}" placeholder="Enter company name">
        </div>
        <div class="md:col-span-1">
          <label class="hrp-label">Company Type:</label>
          <select class="Rectangle-29-select" name="company_type">
            <option>Select Company Type</option>
            <option>Private Limited</option>
            <option>Public Limited</option>
            <option>Partnership</option>
          </select>
        </div>
      </div>

      <!-- Row 4 -->
      <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5">
        <div class="md:col-span-2">
          <label class="hrp-label">Nature Of Work:</label>
          <input class="Rectangle-29" name="nature_of_work" placeholder="Enter Nature">
        </div>
        <div class="md:col-span-1">
          <label class="hrp-label">City:</label>
          <select class="Rectangle-29-select" name="city">
            <option>Select City</option>
            <option>Ahmedabad</option>
            <option>Mumbai</option>
            <option>Delhi</option>
          </select>
        </div>
      </div>

      <!-- Row 5 -->
      <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
        <div>
          <label class="hrp-label">Scope of Work:</label>
          <textarea class="Rectangle-29 Rectangle-29-textarea" name="scope_of_work" placeholder="Enter Scope" style="min-height:80px"></textarea>
        </div>
        <div>
          <label class="hrp-label">Address:</label>
          <textarea class="Rectangle-29 Rectangle-29-textarea" name="address" placeholder="Enter Experience Previous Company Name" style="min-height:80px"></textarea>
        </div>
      </div>

      <!-- Row 6 -->
      <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
        <div>
          <label class="hrp-label">Contact Person 1:</label>
          <input class="Rectangle-29" name="contact_person_1" placeholder="Enter Contact Person Name">
        </div>
        <div>
          <label class="hrp-label">Contact Number 1:</label>
          <input class="Rectangle-29" name="contact_number_1" placeholder="Enter Mobile No" type="tel" pattern="\d{10}" maxlength="10" inputmode="numeric">
        </div>
      </div>

      <!-- Row 7 -->
      <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
        <div>
          <label class="hrp-label">Position 1:</label>
          <input class="Rectangle-29" name="position_1" placeholder="Enter Position">
        </div>
        <div>
          <label class="hrp-label">Contract Copy:</label>
          <div class="upload-pill Rectangle-29">
            <div class="choose">Choose File</div>
            <div class="filename" id="contractCopyName">No File Chosen</div>
            <input id="contractCopyInput" name="contract_copy" type="file" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
          </div>
        </div>
      </div>

      <!-- Row 8 -->
      <div>
        <label class="hrp-label">Contract Short Details:</label>
        <textarea class="Rectangle-29 Rectangle-29-textarea" name="contract_details" placeholder="Enter Your Details"
          style="height:58px;resize:none;"></textarea>
      </div>
      <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
        <div>
          <label class="hrp-label">Company Email:</label>
          <input class="Rectangle-29" type="email" name="company_email" value="{{ $inquiry->email ?? '' }}" placeholder="Add Mail-Id">
        </div>
        <div>
          <label class="hrp-label">Company Password:</label>
          <input class="Rectangle-29" type="password" name="company_password" placeholder="Enter Company Password">
        </div>
      </div>
    </form>
  </div>
  </div>
  
  <!-- Services Table -->
  <div style="margin: 30px 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h3 style="margin-left: 20px; font-size: 18px; font-weight: 600;">Services</h3>
      <div>
        <button type="button" class="inquiry-submit-btn premium-quotation-btn"
          style="background: #ffa500; margin-right: 10px; width: fit-content;">Premium Quotation</button>
        <button type="button" class="inquiry-submit-btn add-more-services-1" style="background: #28a745;">+ Add
          More</button>
      </div>
    </div>

    <!-- Premium Quotation Section -->
 
    <div id="premiumSection" class="Rectangle-30 hrp-compact" style="display: none;">
      <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 600;">Key Features Selection</h3>

      <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 30px;">
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="sample_management" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Sample Management
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="user_friendly_interface" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          User-Friendly Interface
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="contact_management" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Contact Management
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="test_management" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Test Management
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="employee_management" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Employee Management
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="lead_opportunity_management" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Lead and Opportunity Management
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="data_integrity_security" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Data Integrity and Security
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="recruitment_onboarding" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Recruitment and Onboarding
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="sales_automation" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Sales Automation
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="reporting_analytics" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Reporting and Analytics
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="payroll_management" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Payroll Management
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="customer_service_management" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Customer Service Management
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="inventory_management" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Inventory Management
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="training_development" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Training and Development
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="reporting_analytics_2" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Reporting and Analytics
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="integration_capabilities_lab" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Integration Capabilities (Lab)
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="employee_self_service" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Employee Self-Service Portal
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="marketing_automation" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Marketing Automation
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="regulatory_compliance" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Regulatory Compliance
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="analytics_reporting" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Analytics and Reporting
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="integration_capabilities_crm" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Integration Capabilities (CRM)
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="workflow_automation" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Workflow Automation
        </label>
        <label style="display: flex; align-items: center; cursor: pointer; position: relative;" class="custom-checkbox">
          <input type="checkbox" name="features[]" value="integration_capabilities_hr" style="display: none;">
          <div class="checkbox-box" style="width: 16px; height: 16px; border: 2px solid #000; background: white; margin-right: 8px; display: flex; align-items: center; justify-content: center;">
            <span class="checkmark" style="color: white; font-size: 12px; font-weight: bold; display: none;">✓</span>
          </div>
          Integration Capabilities (HR)
        </label>
      </div>

      <div>
        BASIC COST</div>

      <table
        style="width: 100%;">
        <thead>
          <tr>
            <th style="padding: 12px; text-align: left;">Description</th>
            <th style="padding: 12px; text-align: left;">Quantity</th>
            <th style="padding: 12px; text-align: left;">Rate</th>
            <th style="padding: 12px; text-align: left;">Total</th>
            <th style="padding: 12px; text-align: left;">Contract Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                placeholder="Enter Description" style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                placeholder="Enter Quantity" style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" placeholder="Enter Rate"
                style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" placeholder="Total Rate"
                style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" placeholder="Total Rate"
                style="border: none; background: transparent;"></td>
          </tr>
        </tbody>
      </table>

      <div style="margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <h4 style="margin: 0;">Additional Cost</h4>
          <button type="button" class="inquiry-submit-btn add-additional-cost"
            style="background: #28a745; padding: 5px 15px;">+ Add</button>
        </div>

        <table id="additionalCostTable"
          style="width: 100%;">
          <thead>
            <tr style="background: #f8f9fa;">
              <th style="padding: 12px; text-align: left;">Description</th>
              <th style="padding: 12px; text-align: left;">Quantity</th>
              <th style="padding: 12px; text-align: left;">Rate</th>
              <th style="padding: 12px; text-align: left;">Total</th>
              <th style="padding: 12px; text-align: left;">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                  name="additional_cost[description][]" placeholder="Enter Description"
                  style="border: none; background: transparent;"></td>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 additional-quantity"
                  type="number" min="0" step="1" name="additional_cost[quantity][]" placeholder="000" style="border: none; background: transparent;"
                  oninput="calculateAdditionalTotal(this)"></td>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 additional-rate"
                  type="number" min="0" step="0.01" name="additional_cost[rate][]" placeholder="₹ 000" style="border: none; background: transparent;"
                  oninput="calculateAdditionalTotal(this)"></td>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 additional-total"
                  type="number" min="0" step="0.01" name="additional_cost[total][]" placeholder="₹ 0000000" style="border: none; background: transparent;"
                  readonly></td>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><button type="button"
                  class="remove-additional-row"
                  style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px;">×</button>
              </td>
            </tr>
          </tbody>
        </table>

        <div id="additionalCostTotal" style="font-weight: 600; text-align: right; margin-top: 10px;">Total: ₹0.00</div>
      </div>

      <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
          <h4 style="margin: 0;">Annual Maintenance / Visiting / Manpower Support</h4>
          <button type="button" class="inquiry-submit-btn add-maintenance-cost"
            style="background: #28a745; padding: 5px 15px;">+ Add</button>
        </div>

        <table id="maintenanceCostTable"
          style="width: 100% ">
          <thead>
            <tr style="background: #f8f9fa;">
              <th style="padding: 12px; text-align: left;">Description</th>
              <th style="padding: 12px; text-align: left;">Quantity</th>
              <th style="padding: 12px; text-align: left;">Rate</th>
              <th style="padding: 12px; text-align: left;">Total</th>
              <th style="padding: 12px; text-align: left;">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                  name="maintenance_cost[description][]" placeholder="Enter Description"
                  style="border: none; background: transparent;"></td>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 maintenance-quantity"
                  type="number" min="0" step="1" name="maintenance_cost[quantity][]" placeholder="000" style="border: none; background: transparent;"
                  oninput="calculateMaintenanceTotal(this)"></td>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 maintenance-rate"
                  type="number" min="0" step="0.01" name="maintenance_cost[rate][]" placeholder="₹ 000" style="border: none; background: transparent;"
                  oninput="calculateMaintenanceTotal(this)"></td>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 maintenance-total"
                  type="number" min="0" step="0.01" name="maintenance_cost[total][]" placeholder="₹ 0000000" style="border: none; background: transparent;"
                  readonly></td>
              <td style="padding: 12px; border-bottom: 1px solid #eee;"><button type="button"
                  class="remove-maintenance-row"
                  style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px;">×</button>
              </td>
            </tr>
          </tbody>
        </table>

        <div id="maintenanceCostTotal" style="font-weight: 600; text-align: right; margin-top: 10px;">Total: ₹0.00</div>
      </div>
    </div>










    <!-- First Services Table -->
    <div class="Rectangle-30 hrp-compact">
      <table class="services-table-1"
        style="width: 100%;">
        <thead>
          <tr style="background: #f8f9fa;">
            <th style="padding: 12px; text-align: left; font-weight: 600;">Description</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Quantity</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Rate</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Total</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                name="services_1[description][]" placeholder="Enter Description" style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 quantity"
                type="number" min="0" step="1" name="services_1[quantity][]" placeholder="Enter Quantity" style="border: none; background: transparent;" oninput="calculateRowTotal(this)"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 rate"
                type="number" min="0" step="0.01" name="services_1[rate][]" placeholder="Enter Rate" style="border: none; background: transparent;" oninput="calculateRowTotal(this)"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 total"
                type="number" min="0" step="0.01" name="services_1[total][]" placeholder="Total Rate" style="border: none; background: transparent;" readonly></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><button type="button" class="remove-row"
                style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px;">×</button></td>
          </tr>
        </tbody>
      </table>
      
      <!-- Contract Amount Section -->
      <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <label class="hrp-label" style="margin: 0; font-weight: 600;">Contract Amount :</label>
          <input id="contract_amount" class="Rectangle-29" type="number" min="0" step="0.01" name="contract_amount" placeholder="Total Rate" style="width: 200px;" readonly>
        </div>
      </div>
    </div>

      
  </div>

    <!-- AMC Details -->
        <div class="Rectangle-30 hrp-compact">
          
    <div class="hrp-form grid grid-cols-1 md:grid-cols-5 gap-4 md:gap-5" style="margin: 30px 0;">
      <div>
        <label class="hrp-label">AMC Start From:</label>
        <input type="date" class="Rectangle-29" name="amc_start_date">
      </div>
      <div>
        <label class="hrp-label">AMC Amount:</label>
        <input class="Rectangle-29" name="amc_amount" placeholder="Enter Amount">
      </div>
      <div>
        <label class="hrp-label">Project Start Date:</label>
        <input type="date" class="Rectangle-29" name="project_start_date">
      </div>
      <div>
        <label class="hrp-label">Completion Time:</label>
        <input class="Rectangle-29" name="completion_time" placeholder="Enter Time">
      </div>
      <div>
        <label class="hrp-label">Retention Time:</label>
        <input class="Rectangle-29" name="retention_time" placeholder="Enter Time">
      </div>

      <div>
        <label class="hrp-label">Retention Amount:</label>
        <input class="Rectangle-29" name="retention_amount" placeholder="Enter Amount">
      </div>
      <div>
        <label class="hrp-label">Tentative Complete Date:</label>
        <input type="date" class="Rectangle-29" name="tentative_complete_date">
      </div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- Second Services Table -->
  <div style="margin: 30px 0;">
    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
      <button type="button" class="inquiry-submit-btn add-more-services-2" style="background: #28a745;">+ Add
        More</button>
    </div>
    <div class="Rectangle-30 hrp-compact">

      <table class="services-table-2"
        style="width: 100%;">
        <thead>
          <tr>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Description</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Quantity</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Rate</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Total</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Completion (%)</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Completion Terms</th>
            <th style="padding: 12px; text-align: left; font-weight: 600;">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><select class="Rectangle-29-select"
                name="services_2[description][]" style="border: none; background: transparent;">
                <option>Select Service</option>
              </select></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                type="number" min="0" step="1" name="services_2[quantity][]" placeholder="Enter Quantity" style="border: none; background: transparent;">
            </td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                type="number" min="0" step="0.01" name="services_2[rate][]" placeholder="Enter Rate" style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                type="number" min="0" step="0.01" name="services_2[total][]" placeholder="Total Amount" style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                type="number" min="0" max="100" step="1" name="services_2[completion_percent][]" placeholder="Enter %"
                style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29"
                name="services_2[completion_terms][]" placeholder="Enter Terms"
                style="border: none; background: transparent;"></td>
            <td style="padding: 12px; border-bottom: 1px solid #eee;"><button type="button" class="remove-row"
                style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px;">×</button>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="hrp-form grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5" style="margin-top: 20px;">
        <div>
          <label class="hrp-label">Tentative Complete Date:</label>
          <input type="date" class="Rectangle-29" name="tentative_complete_date_2">
        </div>
        <div></div>
      </div>
    </div>
  </div>
  <!-- Terms & Conditions -->
  <div class="Rectangle-30 hrp-compact">

    <div class="hrp-form grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5" style="margin: 30px 0;">
      <div>
        <label class="hrp-label">Custom Terms & Conditions</label>
        <textarea class="Rectangle-29 Rectangle-29-textarea" name="custom_terms" placeholder="Add Terms & Conditions"
          style="height:80px;resize:vertical;"></textarea>
      </div>
      <div>
        <label class="hrp-label">Prepared By:</label>
        <input class="Rectangle-29" name="prepared_by" placeholder="Enter Name">
      </div>
      <div>
        <label class="hrp-label">Mobile No.:</label>
        <input class="Rectangle-29" name="mobile_no" placeholder="Add Mobile No">
      </div>

      <div class="md:col-span-3">
        <label class="hrp-label">Company Name:</label>
        <input class="Rectangle-29" name="footer_company_name" value="CHITRI INFOTECH PVT LTD">
      </div>
    </div>

    <!-- Standard Terms -->
    <div style="margin: 30px 0;">
      <div style="display: flex; align-items: center; margin-bottom: 15px;">
        <span style="margin-right: 10px;">⚫</span>
        <span>Company terms cover a wide range of business concepts</span>
        <div style="margin-left: auto;">
          <button type="button" style="background: none; border: none; color: #007bff; margin-right: 10px;">✏️</button>
          <button type="button" style="background: none; border: none; color: #dc3545;">🗑️</button>
        </div>
      </div>
      <div style="display: flex; align-items: center; margin-bottom: 15px;">
        <span style="margin-right: 10px;">⚫</span>
        <span>Company terms cover a wide range of business concepts</span>
        <div style="margin-left: auto;">
          <button type="button" style="background: none; border: none; color: #007bff; margin-right: 10px;">✏️</button>
          <button type="button" style="background: none; border: none; color: #dc3545;">🗑️</button>
        </div>
      </div>
    </div>
  </div>
  <div style="display:flex;justify-content:end;margin-top:40px;">
    <button type="submit" class="inquiry-submit-btn" style="padding: 15px 40px; font-size: 16px; width: fit-content; ">Add
      Quotation</button>
  </div>

@endsection

@section('breadcrumb')
  <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
  <span class="hrp-bc-sep">›</span>
  <a href="{{ route('inquiries.index') }}">Inquiries</a>
  <span class="hrp-bc-sep">›</span>
  <span class="hrp-bc-current">Make Quotation</span>
@endsection

@push('scripts')
  <script>
    function calculateRowTotal(input) {
      const row = input.closest('tr');
      const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
      const rate = parseFloat(row.querySelector('.rate').value) || 0;
      const total = quantity * rate;
      row.querySelector('.total').value = total.toFixed(2);
      calculateContractAmount();
    }

    function calculateContractAmount() {
      let totalAmount = 0;
      document.querySelectorAll('.total').forEach(input => {
        totalAmount += parseFloat(input.value) || 0;
      });
      document.getElementById('contract_amount').value = totalAmount.toFixed(2);
    }

    function calculateAdditionalTotal(input) {
      const row = input.closest('tr');
      const quantity = parseFloat(row.querySelector('.additional-quantity').value) || 0;
      const rate = parseFloat(row.querySelector('.additional-rate').value) || 0;
      const total = quantity * rate;
      row.querySelector('.additional-total').value = total.toFixed(2);
      calculateAdditionalCostTotal();
    }

    function calculateAdditionalCostTotal() {
      let totalAmount = 0;
      document.querySelectorAll('.additional-total').forEach(input => {
        totalAmount += parseFloat(input.value) || 0;
      });
      document.getElementById('additionalCostTotal').innerHTML = `Total: ₹${totalAmount.toFixed(2)}`;
    }

    function calculateMaintenanceTotal(input) {
      const row = input.closest('tr');
      const quantity = parseFloat(row.querySelector('.maintenance-quantity').value) || 0;
      const rate = parseFloat(row.querySelector('.maintenance-rate').value) || 0;
      const total = quantity * rate;
      row.querySelector('.maintenance-total').value = total.toFixed(2);
      calculateMaintenanceCostTotal();
    }

    function calculateMaintenanceCostTotal() {
      let totalAmount = 0;
      document.querySelectorAll('.maintenance-total').forEach(input => {
        totalAmount += parseFloat(input.value) || 0;
      });
      document.getElementById('maintenanceCostTotal').innerHTML = `Total: ₹${totalAmount.toFixed(2)}`;
    }

    document.addEventListener('DOMContentLoaded', function () {
      // Add More functionality for first services table
      document.querySelector('.add-more-services-1').addEventListener('click', function () {
        const tbody = document.querySelector('.services-table-1 tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" name="services_1[description][]" placeholder="Enter Description" style="border: none; background: transparent;"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 quantity" name="services_1[quantity][]" placeholder="Enter Quantity" style="border: none; background: transparent;" oninput="calculateRowTotal(this)"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 rate" name="services_1[rate][]" placeholder="Enter Rate" style="border: none; background: transparent;" oninput="calculateRowTotal(this)"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 total" name="services_1[total][]" placeholder="Total Rate" style="border: none; background: transparent;" readonly></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><button type="button" class="remove-row" style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px;">×</button></td>
      `;
        tbody.appendChild(newRow);
      });

      // Add More functionality for second services table
      document.querySelector('.add-more-services-2').addEventListener('click', function () {
        const tbody = document.querySelector('.services-table-2 tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><select class="Rectangle-29-select" name="services_2[description][]" style="border: none; background: transparent;"><option>Select Service</option></select></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" name="services_2[quantity][]" placeholder="Enter Quantity" style="border: none; background: transparent;"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" name="services_2[rate][]" placeholder="Enter Rate" style="border: none; background: transparent;"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" name="services_2[total][]" placeholder="Total Amount" style="border: none; background: transparent;"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" name="services_2[completion_percent][]" placeholder="Enter %" style="border: none; background: transparent;"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" name="services_2[completion_terms][]" placeholder="Enter Terms" style="border: none; background: transparent;"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><button type="button" class="remove-row" style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px;">×</button></td>
      `;
        tbody.appendChild(newRow);
      });

      // Remove row functionality
      document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
          const tbody = e.target.closest('tbody');
          if (tbody.children.length > 1) {
            e.target.closest('tr').remove();
            calculateContractAmount();
          }
        }
      });

      // Premium Quotation Section Toggle
      document.querySelector('.premium-quotation-btn').addEventListener('click', function () {
        const section = document.getElementById('premiumSection');
        if (section.style.display === 'none' || section.style.display === '') {
          section.style.display = 'block';
          this.textContent = 'Hide Premium';
          this.style.background = '#dc3545';
        } else {
          section.style.display = 'none';
          this.textContent = 'Premium Quotation';
          this.style.background = '#ffa500';
        }
      });

      // Additional Cost Add More
      document.querySelector('.add-additional-cost').addEventListener('click', function () {
        const tbody = document.querySelector('#additionalCostTable tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" name="additional_cost[description][]" placeholder="Enter Description" style="border: none; background: transparent;"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 additional-quantity" name="additional_cost[quantity][]" placeholder="000" style="border: none; background: transparent;" oninput="calculateAdditionalTotal(this)"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 additional-rate" name="additional_cost[rate][]" placeholder="₹ 000" style="border: none; background: transparent;" oninput="calculateAdditionalTotal(this)"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 additional-total" name="additional_cost[total][]" placeholder="₹ 0000000" style="border: none; background: transparent;" readonly></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><button type="button" class="remove-additional-row" style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px;">×</button></td>
      `;
        tbody.appendChild(newRow);
      });

      // Maintenance Cost Add More
      document.querySelector('.add-maintenance-cost').addEventListener('click', function () {
        const tbody = document.querySelector('#maintenanceCostTable tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29" name="maintenance_cost[description][]" placeholder="Enter Description" style="border: none; background: transparent;"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 maintenance-quantity" name="maintenance_cost[quantity][]" placeholder="000" style="border: none; background: transparent;" oninput="calculateMaintenanceTotal(this)"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 maintenance-rate" name="maintenance_cost[rate][]" placeholder="₹ 000" style="border: none; background: transparent;" oninput="calculateMaintenanceTotal(this)"></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><input class="Rectangle-29 maintenance-total" name="maintenance_cost[total][]" placeholder="₹ 0000000" style="border: none; background: transparent;" readonly></td>
        <td style="padding: 12px; border-bottom: 1px solid #eee;"><button type="button" class="remove-maintenance-row" style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 24px; height: 24px;">×</button></td>
      `;
        tbody.appendChild(newRow);
      });

      // Remove Additional Cost Row
      document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-additional-row')) {
          const tbody = e.target.closest('tbody');
          if (tbody.children.length > 1) {
            e.target.closest('tr').remove();
            calculateAdditionalCostTotal();
          }
        }
      });

      // Remove Maintenance Cost Row
      document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-maintenance-row')) {
          const tbody = e.target.closest('tbody');
          if (tbody.children.length > 1) {
            e.target.closest('tr').remove();
            calculateMaintenanceCostTotal();
          }
        }
      });

      // Custom Checkbox Functionality
      document.querySelectorAll('.custom-checkbox').forEach(function(label) {
        label.addEventListener('click', function(e) {
          e.preventDefault();
          const checkbox = this.querySelector('input[type="checkbox"]');
          const box = this.querySelector('.checkbox-box');
          const checkmark = this.querySelector('.checkmark');
          
          checkbox.checked = !checkbox.checked;
          
          if (checkbox.checked) {
            box.style.background = '#000';
            checkmark.style.display = 'block';
          } else {
            box.style.background = 'white';
            checkmark.style.display = 'none';
          }
        });
      });
    });
  </script>
@endpush