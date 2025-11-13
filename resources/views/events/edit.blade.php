@extends('layouts.macos')
@section('page_title', 'Edit Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('new_theme/css/events.css') }}">
<style>
  /* Hide header menu toggle on Events page only */
  .hrp-menu-toggle{ display:none !important; }
  @media (max-width: 768px){
    .hrp-menu-toggle{ display:inline-flex !important; }
  }
  /* Keep header title area aligned */
  .hrp-header-left{ gap: 0; }
  /* Scoped styles for Create Event modal */
  .event-modal .modal-title{ font-size: 18px; font-weight: 800; }
  .event-modal .hrp-label{ font-size: 14px; font-weight: 700; color:#374151; margin-bottom:6px; }
  .event-modal .Rectangle-29{ font-size:14px; padding:10px 12px; height:auto; border-radius:12px; }
  .event-modal textarea.Rectangle-29{ min-height:100px; }
  .event-modal .hrp-btn{ padding:10px 18px; border-radius:10px; font-size:14px; font-weight:700; }
 </style>
@endpush

@section('content')
<div class="events-container">
    <!-- Header -->
    <div class="events-header">
        <div class="events-search-container">
            <h1 style="margin: 0; font-size: 24px; font-weight: 600; color: #1f2937;">Edit Event</h1>
        </div>
        <a href="{{ route('events.index') }}" class="add-event-btn" style="background: #6b7280;">
            <span>←</span>
            Back to Events
        </a>
    </div>

    <!-- Form -->
    <div style="padding: 20px 24px;">
        <div style="background: white; border-radius: 16px; padding: 32px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 0 auto;">
            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PATCH')

                <div style="margin-bottom: 16px;">
                    <label class="hrp-label">Event Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" class="Rectangle-29" required value="{{ old('name', $event->name) }}" placeholder="Enter event name">
                    @error('name')
                      <div style="color:#ef4444; font-size:13px; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 0;">
                    <label class="hrp-label">Description</label>
                    <textarea name="description" class="Rectangle-29 Rectangle-29-textarea" placeholder="Enter description" style="height:58px; resize:none;">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                      <div style="color:#ef4444; font-size:13px; margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 16px;">
                    <a href="{{ route('events.show', $event) }}" 
                       class="hrp-btn" style="background:#f3f4f6; color:#111;">
                        Cancel
                    </a>
                    <button type="submit" class="hrp-btn" style="background:#f97316; color:white;">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection