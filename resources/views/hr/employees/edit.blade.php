@extends('layouts.macos')
@section('page_title', $page_title)

@section('content')
  <div class="hrp-card">
    <div class="hrp-card-body">
      <form method="POST" action="{{ route('employees.update', $employee) }}" enctype="multipart/form-data" class="space-y-3">
        @csrf
        @method('PUT')
        <label class="hrp-label">Name</label>
        <input name="name" class="hrp-input" value="{{ old('name', $employee->name) }}" required>
        @error('name')<p class="hrp-error">{{ $message }}</p>@enderror

        <label class="hrp-label">Email</label>
        <input name="email" type="email" class="hrp-input" value="{{ old('email', $employee->email) }}" required>
        @error('email')<p class="hrp-error">{{ $message }}</p>@enderror

        <label class="hrp-label">Photo</label>
        <input name="photo" type="file" class="hrp-file" accept="image/*">
        @if($employee->photo_path)
          <div class="text-sm" style="margin-top:6px">Current: <img src="{{ asset('storage/'.$employee->photo_path) }}" alt="Photo" style="height:48px;border-radius:6px;border:1px solid #e5e7eb"></div>
        @endif
        @error('photo')<p class="hrp-error">{{ $message }}</p>@enderror

        <div class="hrp-actions" style="gap:8px">
          <a href="{{ route('employees.index') }}" class="hrp-btn" style="background:#e5e7eb">Cancel</a>
          <button class="hrp-btn hrp-btn-primary">Update Employee</button>
        </div>
      </form>
    </div>
  </div>
  <div class="hrp-breadcrumb"><div class="crumb"><a href="{{ route('dashboard') }}">Dashboard</a>  ›  <a href="{{ route('employees.index') }}">Employee List</a>  ›  Edit</div></div>
@endsection
