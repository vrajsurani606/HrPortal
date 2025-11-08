@extends('layouts.macos')
@section('page_title', $page_title)

@section('content')
  <div class="hrp-card">
    <div class="hrp-card-body">
      <div class="Rectangle-30">
      <form method="POST" action="{{ route('hiring.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        <div>
          <label class="hrp-label">Unique Code:</label>
          <input name="unique_code" value="{{ old('unique_code', $nextCode) }}" class="hrp-input Rectangle-29" readonly>
        </div>
  @push('scripts')
  <script>
    (function(){
      var input = document.getElementById('resumeInput');
      var label = document.getElementById('resumeFileName');
      if(input && label){
        input.addEventListener('change', function(){
          var name = this.files && this.files.length ? this.files[0].name : 'No File Chosen';
          label.textContent = name;
        });
      }
    })();
  </script>
  @endpush
        <div>
          <label class="hrp-label">Person Name:</label>
          <input name="person_name" value="{{ old('person_name') }}" placeholder="Enter Full Name" class="hrp-input Rectangle-29" required>
        </div>
        
        <div>
          <label class="hrp-label">Mobile No:</label>
          <input name="mobile_no" value="{{ old('mobile_no') }}" placeholder="XXXX XXXXX" class="hrp-input Rectangle-29" required>
        </div>
        <div>
          <label class="hrp-label">Address:</label>
          <textarea name="address" placeholder="Enter Your Address" class="hrp-textarea Rectangle-29 Rectangle-29-textarea">{{ old('address') }}</textarea>
        </div>
        <div>
          <label class="hrp-label">Position:</label>
          <input name="position" value="{{ old('position') }}" placeholder="Enter Position" class="hrp-input Rectangle-29">
        </div>
        <div>
          <label class="hrp-label">Is experience ?:</label>
          <select name="is_experience" class="hrp-input Rectangle-29 Rectangle-29-select" required>
            <option value="0" {{ old('is_experience')==='0' ? 'selected' : '' }} class="hrp-input Rectangle-29">No</option>
            <option value="1" {{ old('is_experience')==='1' ? 'selected' : '' }} class="hrp-input Rectangle-29">Yes</option>
          </select>
        </div>
        <div>
          <label class="hrp-label">Experience Count:</label>
          <input name="experience_count" value="{{ old('experience_count') }}" placeholder="Enter No. of Exp. e.g. 2.5" class="hrp-input Rectangle-29" type="number" step="0.1" min="0">
        </div>
        <div>
          <label class="hrp-label">Experience previous Company:</label>
          <input name="experience_previous_company" value="{{ old('experience_previous_company') }}" placeholder="Enter Experience Previous Company Name" class="hrp-input Rectangle-29">
        </div>
        <div>
          <label class="hrp-label">Previous Salary:</label>
          <input name="previous_salary" value="{{ old('previous_salary') }}" placeholder="Enter Salary" class="hrp-input Rectangle-29" type="number" step="0.01" min="0">
        </div>
        <div>
          <label class="hrp-label">Resume Upload:</label>
          <div class="upload-pill">
            <div class="choose">Choose File</div>
            <div class="filename" id="resumeFileName">No File Chosen</div>
            <input id="resumeInput" name="resume" type="file" accept=".pdf,.doc,.docx">
          </div>
        </div>
        <div class="md:col-span-1">
          <label class="hrp-label">Gender:</label>
          @php($g = old('gender'))
          <div class="hrp-segment">
            <input id="g-male" type="radio" name="gender" value="male" {{ $g==='male' ? 'checked' : '' }}><label for="g-male">Male</label>
            <input id="g-female" type="radio" name="gender" value="female" {{ $g==='female' ? 'checked' : '' }}><label for="g-female">Female</label>
            <input id="g-other" type="radio" name="gender" value="other" {{ $g==='other' ? 'checked' : '' }}><label for="g-other">Other</label>
          </div>
        </div>
        <div class="md:col-span-2">
          <div class="hrp-actions">
            <button class="hrp-btn hrp-btn-primary">Add Hiring Lead Master</button>
          </div>
        </div>
      </form>
      </div>
    </div>

  <div class="hrp-breadcrumb">
    <div class="crumb"><a href="{{ route('dashboard') }}">Dashboard</a>  ›  <a href="{{ route('hiring.index') }}">Hiring Lead Master</a>  ›  Add New Hiring Lead</div>
    <div class="hrp-pagination">
      <button type="button" class="hrp-page-btn" aria-label="Previous">«</button>
      <div class="hrp-pages">
        <a href="#" class="hrp-page active">01</a>
        <a href="#" class="hrp-page">02</a>
        <a href="#" class="hrp-page">03</a>
        <a href="#" class="hrp-page">04</a>
        <a href="#" class="hrp-page">05</a>
        <span class="hrp-ellipsis">…</span>
        <a href="#" class="hrp-page">20</a>
      </div>
      <button type="button" class="hrp-page-btn" aria-label="Next">»</button>
    </div>
  </div>
    </div>
@endsection
