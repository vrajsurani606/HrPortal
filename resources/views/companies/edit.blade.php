@extends('layouts.macos')
@section('page_title', 'Edit Company')
@section('content')
  <div class="hrp-card">
    <div class="hrp-card-header"><h2 class="hrp-card-title">Edit Company (Placeholder)</h2></div>
    <div class="hrp-card-body">
      <div class="bg-white rounded p-6">This is a placeholder edit screen. Replace with real form later.</div>
    </div>
  </div>
@endsection

@section('breadcrumb')
  <a class="hrp-bc-home" href="{{ route('dashboard') }}">Dashboard</a>
  <span class="hrp-bc-sep">›</span>
  <a class="hrp-bc-home" href="{{ route('companies.index') }}">Companies</a>
  <span class="hrp-bc-sep">›</span>
  <span class="hrp-bc-current">Edit</span>
@endsection
