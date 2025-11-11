@extends('layouts.macos')

@section('page_title','Add New Hiring Lead')

@section('content')
<div class="Rectangle-30 hrp-compact">
  @if (session('status'))
    <div class="alert alert-success" style="border-radius:12px;">{{ session('status') }}</div>
  @endif
  
  @if ($errors->any())
    <div class="alert alert-danger" style="border-radius:12px;margin-bottom:20px;">
      <strong>Please fix the following errors:</strong>
      <ul style="margin:10px 0 0 20px;">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form id="inquiryForm" method="POST" action="{{ route('inquiries.store') }}" enctype="multipart/form-data" class="hrp-form grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
    @csrf

    <!-- Row 1: Unique Code and Inquiry Date -->
    <div>
      <label class="hrp-label">Unique Code:</label>
      <input class="Rectangle-29" name="unique_code" value="{{ old('unique_code','CMS/LEAD/0022') }}" placeholder="CMS/LEAD/0022" />
      @error('unique_code')<div class="error-message">{{ $message }}</div>@enderror
    </div>
    <div>
      <label class="hrp-label">Inquiry Date :</label>
      <input type="date" class="Rectangle-29" name="inquiry_date" value="{{ old('inquiry_date') }}" />
    </div>

    <!-- Row 2: Company Name and Company Address -->
    <div>
      <label class="hrp-label">Company Name :</label>
      <input class="Rectangle-29" name="company_name" value="{{ old('company_name', 'Tech Solutions Pvt Ltd') }}" placeholder="Enter your company name" />
      @error('company_name')<div class="error-message">{{ $message }}</div>@enderror
    </div>
    <div>
      <label class="hrp-label">Company Address:</label>
      <textarea class="Rectangle-29 Rectangle-29-textarea" name="company_address" placeholder="Enter Your Address" style="height:58px;resize:none;">{{ old('company_address', '123 Business Park, Ahmedabad, Gujarat') }}</textarea>
    </div>

    <!-- Row 3: Industry Type and Email -->
    <div>
      <label class="hrp-label">Industry Type :</label>
      <input class="Rectangle-29" name="industry_type" value="{{ old('industry_type', 'Information Technology') }}" placeholder="Enter Industry Type" />
    </div>
    <div>
      <label class="hrp-label">Email :</label>
      <select class="Rectangle-29-select" name="email">
        <option value="">Select your Option</option>
        <option value="info@techsolutions.com" {{ old('email') == 'info@techsolutions.com' ? 'selected' : '' }}>info@techsolutions.com</option>
        <option value="contact@company.com" {{ old('email') == 'contact@company.com' ? 'selected' : '' }}>contact@company.com</option>
      </select>
      @error('email')<div class="error-message">{{ $message }}</div>@enderror
    </div>

    <!-- Row 4: Company Mo. No. and City -->
    <div>
      <label class="hrp-label">Company Mo. No. :</label>
      <input class="Rectangle-29" name="company_phone" value="{{ old('company_phone', '9876543210') }}" placeholder="Enter Company Mobile Number" />
    </div>
    <div>
      <label class="hrp-label">City</label>
      <input class="Rectangle-29" name="city" value="{{ old('city', 'Ahmedabad') }}" placeholder="Enter City Name" />
    </div>

    <!-- Row 5: State and Contact Person Mobile No -->
    <div>
      <label class="hrp-label">State</label>
      <input class="Rectangle-29" name="state" value="{{ old('state', 'Gujarat') }}" placeholder="Enter State Name" />
    </div>
    <div>
      <label class="hrp-label">Contact Person Mobile No:</label>
      <input class="Rectangle-29" name="contact_mobile" value="{{ old('contact_mobile', '9123456789') }}" placeholder="Enter Contact Person Mobile No" />
    </div>

    <!-- Row 6: Contact Person Name and Scope Link -->
    <div>
      <label class="hrp-label">Contact Person Name:</label>
      <input class="Rectangle-29" name="contact_name" value="{{ old('contact_name', 'John Doe') }}" placeholder="Enter Contact Person Name" />
    </div>
    <div>
      <label class="hrp-label">Scope Link:</label>
      <input class="Rectangle-29" name="scope_link" value="{{ old('scope_link', 'https://example.com/scope') }}" placeholder="Enter Scope Link" />
    </div>

    <!-- Row 7: Contact Person Position and Quotation Upload -->
    <div>
      <label class="hrp-label">Contact Person Position:</label>
      <input class="Rectangle-29" name="contact_position" value="{{ old('contact_position', 'Project Manager') }}" placeholder="Enter Contact Person Position" />
    </div>
    <div>
      <label class="hrp-label">Quotation Upload:</label>
      <div class="upload-pill Rectangle-29">
        <div class="choose">Choose File</div>
        <div class="filename">No File Chosen</div>
        <input type="file" id="quotation_file" name="quotation_file">
      </div>
    </div>

    <!-- Row 8: Quotation Sent -->
    <div>
      <label class="hrp-label">Quotation Sent:</label>
      <input class="Rectangle-29" name="quotation_sent" value="{{ old('quotation_sent', 'Yes - Sent on ' . date('Y-m-d')) }}" placeholder="Enter Quotation Status" />
    </div>

    <div class="md:col-span-2">
      <div style="display:flex;justify-content:flex-end;margin-top:30px;">
        <button type="submit" class="inquiry-submit-btn" id="submitBtn">Add Inquiry</button>
      </div>
    </div>
  </form>
</div>
@endsection

@section('breadcrumb')
  <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
  <span class="hrp-bc-sep">›</span>
  <span class="hrp-bc-current">Add New Hiring Lead</span>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const fileInput = document.getElementById('quotation_file');
  const filenameSpan = document.querySelector('.filename');
  const form = document.getElementById('inquiryForm');
  const submitBtn = document.getElementById('submitBtn');
  
  if (fileInput && filenameSpan) {
    fileInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        filenameSpan.textContent = this.files[0].name;
        filenameSpan.style.color = '#374151';
      } else {
        filenameSpan.textContent = 'No file Chosen';
        filenameSpan.style.color = '#9ca3af';
      }
    });
  }
  
  // AJAX form submission
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(form);
      submitBtn.disabled = true;
      submitBtn.textContent = 'Saving...';
      
      fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]').value
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Show success message
          const successDiv = document.createElement('div');
          successDiv.className = 'alert alert-success';
          successDiv.style.cssText = 'border-radius:12px;margin-bottom:20px;padding:15px;background:#d4edda;color:#155724;border:1px solid #c3e6cb;';
          successDiv.innerHTML = '<strong>Success!</strong> ' + data.message;
          form.parentNode.insertBefore(successDiv, form);
          
          // Reset form
          form.reset();
          filenameSpan.textContent = 'No file Chosen';
          filenameSpan.style.color = '#9ca3af';
          
          // Remove success message after 3 seconds
          setTimeout(() => successDiv.remove(), 3000);
        } else {
          throw new Error(data.message || 'Something went wrong');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Error: ' + error.message);
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Add Inquiry';
      });
    });
  }
});
</script>
@endpush
