@extends('layouts.macos')
@section('page_title', $page_title)

@section('content')
  <div class="hrp-card">
    <div class="hrp-card-body">
      <form method="POST" action="{{ route('hiring.update', $lead) }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('PUT')
        <div>
          <label class="hrp-label">Unique Code:</label>
          <input name="unique_code" value="{{ $lead->unique_code }}" class="hrp-input Rectangle-29" readonly>
        </div>
        <div>
          <label class="hrp-label">Person Name:</label>
          <input name="person_name" value="{{ old('person_name', $lead->person_name) }}" class="hrp-input Rectangle-29" required>
        </div>
        <div>
          <label class="hrp-label">Mobile No:</label>
          <input name="mobile_no" value="{{ old('mobile_no', $lead->mobile_no) }}" class="hrp-input Rectangle-29" required>
        </div>
        <div>
          <label class="hrp-label">Address:</label>
          <input name="address" value="{{ old('address', $lead->address) }}" class="hrp-input Rectangle-29">
        </div>
        <div>
          <label class="hrp-label">Position:</label>
          <input name="position" value="{{ old('position', $lead->position) }}" class="hrp-input Rectangle-29">
        </div>
        <div>
          <label class="hrp-label">Is experience ?:</label>
          <select name="is_experience" class="hrp-input Rectangle-29" required>
            <option value="0" {{ old('is_experience', (int)!$lead->is_experience) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('is_experience', (int)$lead->is_experience) == 1 ? 'selected' : '' }}>Yes</option>
          </select>
        </div>
        <div>
          <label class="hrp-label">Experience Count:</label>
          <input name="experience_count" value="{{ old('experience_count', $lead->experience_count) }}" placeholder="Ex: 2.5" class="hrp-input Rectangle-29" type="number" step="0.1" min="0">
        </div>
        <div>
          <label class="hrp-label">Experience previous Company:</label>
          <input name="experience_previous_company" value="{{ old('experience_previous_company', $lead->experience_previous_company) }}" class="hrp-input Rectangle-29">
        </div>
        <div>
          <label class="hrp-label">Previous Salary:</label>
          <input name="previous_salary" value="{{ old('previous_salary', $lead->previous_salary) }}" class="hrp-input Rectangle-29" type="number" step="0.01" min="0">
        </div>
        <div>
          <label class="hrp-label">Resume Upload:</label>
          <input name="resume" type="file" class="hrp-file" accept=".pdf,.doc,.docx">
          @if($lead->resume_path)
            <div class="text-sm" style="margin-top:6px">Current: <a class="hrp-link" href="{{ asset('storage/'.$lead->resume_path) }}" target="_blank">View</a></div>
          @endif
        </div>
        <div>
          <label class="hrp-label">Gender:</label>
          <div class="flex items-center gap-6">
            @php($g = old('gender', $lead->gender))
            <label class="inline-flex items-center gap-2"><input type="radio" name="gender" value="male" {{ $g==='male' ? 'checked' : '' }}> <span>Male</span></label>
            <label class="inline-flex items-center gap-2"><input type="radio" name="gender" value="female" {{ $g==='female' ? 'checked' : '' }}> <span>Female</span></label>
            <label class="inline-flex items-center gap-2"><input type="radio" name="gender" value="other" {{ $g==='other' ? 'checked' : '' }}> <span>Other</span></label>
          </div>
        </div>
        <div class="md:col-span-2">
          <div class="hrp-actions" style="gap:8px">
            <a href="{{ route('hiring.index') }}" class="hrp-btn" style="background:#e5e7eb">Cancel</a>
            <button class="hrp-btn hrp-btn-primary">Update Hiring Lead</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="hrp-breadcrumb"><div class="crumb"><a href="{{ route('dashboard') }}">Dashboard</a>  ›  <a href="{{ route('hiring.index') }}">Hiring Lead Master</a>  ›  Edit</div></div>
@endsection
