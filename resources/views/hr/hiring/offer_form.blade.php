@extends('layouts.macos')
@section('page_title', $page_title)

@section('content')
  <div class="hrp-card">
    <div class="Rectangle-30 hrp-compact">
      <form method="POST" action="{{ $offer ? route('hiring.offer.update', $lead->id) : route('hiring.offer.store', $lead->id) }}" class="hrp-form grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-3" id="offerForm">
        @csrf
        @if($offer)
          @method('PUT')
        @endif

        <div class="md:col-span-2">
          <div class="hrp-alert hrp-alert-info" role="alert">
            <strong>Hiring Lead:</strong> {{ $lead->unique_code }} — {{ $lead->person_name }} ({{ $lead->position }})
          </div>
        </div>

        <div>
          <label class="hrp-label">Letter Issue Date:</label>
          <input type="date" name="issue_date" value="{{ old('issue_date', optional($offer->issue_date ?? null)->format('Y-m-d')) }}" class="hrp-input Rectangle-29">
          @error('issue_date')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div>
          <label class="hrp-label">Letter Note:</label>
          <input name="note" value="{{ old('note', $offer->note ?? '') }}" placeholder="Optional note" class="hrp-input Rectangle-29">
          @error('note')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div>
          <label class="hrp-label">Monthly Salary:</label>
          <input type="number" step="0.01" min="0" name="monthly_salary" value="{{ old('monthly_salary', $offer->monthly_salary ?? '') }}" placeholder="e.g. 35000" class="hrp-input Rectangle-29">
          @error('monthly_salary')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div>
          <label class="hrp-label">Annual CTC:</label>
          <input type="number" step="0.01" min="0" name="annual_ctc" value="{{ old('annual_ctc', $offer->annual_ctc ?? '') }}" placeholder="e.g. 420000" class="hrp-input Rectangle-29">
          @error('annual_ctc')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div>
          <label class="hrp-label">Reporting Manager:</label>
          <input name="reporting_manager" value="{{ old('reporting_manager', $offer->reporting_manager ?? '') }}" placeholder="Manager name" class="hrp-input Rectangle-29">
          @error('reporting_manager')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div>
          <label class="hrp-label">Working Hours:</label>
          <input name="working_hours" value="{{ old('working_hours', $offer->working_hours ?? '') }}" placeholder="e.g. 9:30 AM - 6:30 PM" class="hrp-input Rectangle-29">
          @error('working_hours')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div>
          <label class="hrp-label">Date of Joining:</label>
          <input type="date" name="date_of_joining" value="{{ old('date_of_joining', optional($offer->date_of_joining ?? null)->format('Y-m-d')) }}" class="hrp-input Rectangle-29">
          @error('date_of_joining')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div class="md:col-span-2">
          <label class="hrp-label">Probation Period (bulleted lines):</label>
          <textarea name="probation_period" rows="4" class="hrp-textarea Rectangle-29 Rectangle-29-textarea" placeholder="Enter each point on new line">{{ old('probation_period', $offer->probation_period ?? '') }}</textarea>
          @error('probation_period')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div class="md:col-span-2">
          <label class="hrp-label">Salary & Increment (bulleted lines):</label>
          <textarea name="salary_increment" rows="4" class="hrp-textarea Rectangle-29 Rectangle-29-textarea" placeholder="Enter each point on new line">{{ old('salary_increment', $offer->salary_increment ?? '') }}</textarea>
          @error('salary_increment')<small class="hrp-error">{{ $message }}</small>@enderror
        </div>

        <div class="md:col-span-2">
          <div class="hrp-actions">
            <button class="hrp-btn hrp-btn-primary" name="save" value="1">{{ $offer ? 'Update Offer Letter' : 'Save Offer Letter' }}</button>
            <button class="hrp-btn" name="save_and_print" value="1">Save & Print</button>
            <a class="hrp-btn hrp-btn-ghost" href="{{ route('hiring.index') }}">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('breadcrumb')
  <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
  <span class="hrp-bc-sep">›</span>
  <a href="{{ route('hiring.index') }}" style="font-weight:800;color:#0f0f0f;text-decoration:none">HRM</a>
  <span class="hrp-bc-sep">›</span>
  <span class="hrp-bc-current">{{ $page_title }}</span>
@endsection
