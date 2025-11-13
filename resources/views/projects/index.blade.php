@extends('layouts.macos')
@section('page_title', 'Projects')
@push('styles')
<link rel="stylesheet" href="{{ asset('new_theme/css/kanban.css') }}">
@endpush
@section('content')
<div class="hrp-content">
  <!-- Header with search and controls -->
  <div class="kanban-header">
    <div class="search-container">
      <input type="text" class="kanban-search" placeholder="Type to search..">
    </div>
    <div class="header-controls">
      <div class="board-selector">
        <span>Designer Board</span>
        <svg width="12" height="8" viewBox="0 0 12 8" fill="none">
          <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <button class="download-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <polyline points="7,10 12,15 17,10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <line x1="12" y1="15" x2="12" y2="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
      <div class="notification-badge">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M13.73 21a2 2 0 0 1-3.46 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="badge">3</span>
      </div>
      <button class="create-stage-btn" onclick="openStageModal()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
          <line x1="12" y1="5" x2="12" y2="19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        Create
      </button>
    </div>
  </div>

  <!-- Kanban Board -->
  <div class="kanban-board">
    @foreach($stages as $stage)
    <div class="kanban-column" style="background: {{ $stage->color }}" data-stage-id="{{ $stage->id }}">
      <div class="column-header">
        <div class="column-title">
          <span>{{ $stage->name }}</span>
        </div>
        <button class="add-card-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <line x1="12" y1="5" x2="12" y2="19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <div class="kanban-cards" data-stage-id="{{ $stage->id }}">
        @foreach($stage->projects as $project)
        <div class="kanban-card" draggable="true" data-project-id="{{ $project->id }}">
          <div class="card-header">
            <h3>{{ $project->name }}</h3>
            @if($project->due_date)
            <span class="card-date">{{ $project->due_date->format('d/m/y') }}</span>
            @endif
          </div>
          <div class="card-meta">
            <div class="card-stats">
              <span class="stat-item">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" fill="none"/>
                  <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
              </span>
              <span class="stat-item">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                  <path d="M9 11H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2h-4" stroke="currentColor" stroke-width="2" fill="none"/>
                  <polyline points="9,11 12,14 15,11" stroke="currentColor" stroke-width="2" fill="none"/>
                  <line x1="12" y1="2" x2="12" y2="14" stroke="currentColor" stroke-width="2"/>
                </svg>
              </span>
              <span class="task-count">{{ $project->completed_tasks }}/{{ $project->total_tasks }}</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endforeach
  </div>

  <!-- Create Stage Modal -->
  <div id="stageModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Create New Stage</h3>
        <button onclick="closeStageModal()" class="close-btn">&times;</button>
      </div>
      <form id="stageForm">
        @csrf
        <div class="form-group">
          <label for="stageName">Stage Name</label>
          <input type="text" id="stageName" name="name" class="form-input" placeholder="Enter stage name" required>
        </div>
        <div class="form-group">
          <label for="stageColor">Choose Stage Color</label>
          <div class="color-input-wrapper">
            <div class="color-preview" id="colorPreview" style="background-color: #6b7280;" onclick="document.getElementById('stageColor').click()"></div>
            <input type="color" id="stageColor" name="color" class="color-input" value="#6b7280" required>
            <input type="text" id="colorText" class="color-text" value="#6B7280" readonly>
          </div>
          <div class="color-presets">
            <div class="color-preset" style="background: linear-gradient(135deg, #d3b5df, #c084fc);" onclick="setColor('#d3b5df')" title="Purple"></div>
            <div class="color-preset" style="background: linear-gradient(135deg, #ebc58f, #f59e0b);" onclick="setColor('#ebc58f')" title="Orange"></div>
            <div class="color-preset" style="background: linear-gradient(135deg, #b9f3fc, #3b82f6);" onclick="setColor('#b9f3fc')" title="Blue"></div>
            <div class="color-preset" style="background: linear-gradient(135deg, #abd1a5, #10b981);" onclick="setColor('#abd1a5')" title="Green"></div>
            <div class="color-preset" style="background: linear-gradient(135deg, #fca5a5, #ef4444);" onclick="setColor('#fca5a5')" title="Red"></div>
            <div class="color-preset" style="background: linear-gradient(135deg, #fde68a, #f59e0b);" onclick="setColor('#fde68a')" title="Yellow"></div>
            <div class="color-preset" style="background: linear-gradient(135deg, #c7d2fe, #6366f1);" onclick="setColor('#c7d2fe')" title="Indigo"></div>
            <div class="color-preset" style="background: linear-gradient(135deg, #fed7d7, #f87171);" onclick="setColor('#fed7d7')" title="Pink"></div>
          </div>
        </div>
        <div class="form-actions">
          <button type="button" onclick="closeStageModal()" class="btn-cancel">Cancel</button>
          <button type="submit" class="btn-create">Create Stage</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
let draggedElement = null;

// Drag and Drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.kanban-card');
    const columns = document.querySelectorAll('.kanban-cards');

    cards.forEach(card => {
        card.addEventListener('dragstart', function(e) {
            draggedElement = this;
            this.style.opacity = '0.5';
        });

        card.addEventListener('dragend', function(e) {
            this.style.opacity = '1';
            draggedElement = null;
        });
    });

    columns.forEach(column => {
        column.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.backgroundColor = 'rgba(255,255,255,0.1)';
        });

        column.addEventListener('dragleave', function(e) {
            this.style.backgroundColor = '';
        });

        column.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.backgroundColor = '';
            
            if (draggedElement) {
                const projectId = draggedElement.dataset.projectId;
                const newStageId = this.dataset.stageId;
                
                // Move element visually
                this.appendChild(draggedElement);
                
                // Update backend
                updateProjectStage(projectId, newStageId);
            }
        });
    });

    // Color picker functionality
    const colorInput = document.getElementById('stageColor');
    const colorPreview = document.getElementById('colorPreview');
    const colorText = document.getElementById('colorText');

    if (colorInput && colorPreview && colorText) {
        colorInput.addEventListener('input', function() {
            const color = this.value;
            colorPreview.style.backgroundColor = color;
            colorText.value = color.toUpperCase();
        });
    }
});

function updateProjectStage(projectId, stageId) {
    fetch(`/projects/${projectId}/stage`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ stage_id: stageId })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error('Failed to update project stage');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Color preset function
function setColor(color) {
    const colorInput = document.getElementById('stageColor');
    const colorPreview = document.getElementById('colorPreview');
    const colorText = document.getElementById('colorText');
    
    colorInput.value = color;
    colorPreview.style.backgroundColor = color;
    colorText.value = color.toUpperCase();
}

// Modal functions
function openStageModal() {
    document.getElementById('stageModal').style.display = 'flex';
    // Reset form
    document.getElementById('stageName').value = '';
    setColor('#6b7280');
}

function closeStageModal() {
    document.getElementById('stageModal').style.display = 'none';
}

// Stage creation
document.getElementById('stageForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("project-stages.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        closeStageModal();
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error creating stage. Please try again.');
    });
});
</script>
@endpush
@endsection