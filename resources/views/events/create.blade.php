@extends('layouts.macos')
@section('page_title', 'Add Event')

@push('styles')
<link rel="stylesheet" href="{{ asset('new_theme/css/events.css') }}">
@endpush

@section('content')
<div class="events-container">
    <!-- Header -->
    <div class="events-header">
        <div class="events-search-container">
            <h1 style="margin: 0; font-size: 24px; font-weight: 600; color: #1f2937;">Add New Event</h1>
        </div>
        <a href="{{ route('events.index') }}" class="add-event-btn" style="background: #6b7280;">
            <img src="{{ asset('action_icon/rightclick.svg') }}" alt="Back" style="width: 16px; height: 16px; transform: rotate(180deg);">
            Back to Events
        </a>
    </div>

    <!-- Form -->
    <div style="padding: 20px 24px;">
        <div class="form-container">
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Event Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="form-input" placeholder="Enter event name">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-input form-textarea" placeholder="Enter event description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Event Images</label>
                    <div class="image-upload-area" id="uploadArea">
                        <img src="{{ asset('action_icon/upload.svg') }}" alt="Upload" class="upload-icon">
                        <div class="upload-text">Drop images here or click to upload</div>
                        <div class="upload-subtext">PNG, JPG, GIF up to 2MB each</div>
                        <input type="file" name="images[]" multiple accept="image/*" class="file-input" id="fileInput">
                    </div>
                    <div class="image-preview" id="imagePreview"></div>
                    @error('images.*')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="btn-group">
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">
                        <img src="{{ asset('action_icon/rightclick.svg') }}" alt="Cancel" class="btn-icon" style="transform: rotate(180deg);">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <img src="{{ asset('action_icon/pluse.svg') }}" alt="Create" class="btn-icon" style="filter: invert(1);">
                        Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('fileInput');
const imagePreview = document.getElementById('imagePreview');
let selectedFiles = [];

// Click to upload
uploadArea.addEventListener('click', () => fileInput.click());

// Drag and drop
uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    handleFiles(e.dataTransfer.files);
});

// File input change
fileInput.addEventListener('change', (e) => {
    handleFiles(e.target.files);
});

function handleFiles(files) {
    Array.from(files).forEach(file => {
        if (file.type.startsWith('image/') && file.size <= 2 * 1024 * 1024) {
            selectedFiles.push(file);
            displayImage(file);
        } else {
            toastr.error(`${file.name} is not a valid image or exceeds 2MB`);
        }
    });
    updateFileInput();
}

function displayImage(file) {
    const reader = new FileReader();
    reader.onload = (e) => {
        const previewItem = document.createElement('div');
        previewItem.className = 'preview-item';
        previewItem.innerHTML = `
            <img src="${e.target.result}" alt="Preview">
            <button type="button" class="preview-remove" onclick="removeImage(this, '${file.name}')">×</button>
        `;
        imagePreview.appendChild(previewItem);
    };
    reader.readAsDataURL(file);
}

function removeImage(button, fileName) {
    selectedFiles = selectedFiles.filter(file => file.name !== fileName);
    button.parentElement.remove();
    updateFileInput();
}

function updateFileInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(file => dt.items.add(file));
    fileInput.files = dt.files;
}

// Form submission with loading state
document.getElementById('eventForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span style="margin-right: 8px;">Creating...</span>';
});
</script>
@endpush
@endsection
