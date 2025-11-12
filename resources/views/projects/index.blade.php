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
    </div>
  </div>

  <!-- Kanban Board -->
  <div class="kanban-board">
    <!-- Upcoming Column -->
    <div class="kanban-column upcoming">
      <div class="column-header">
        <div class="column-title">
          <div class="column-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke="currentColor" stroke-width="2" fill="none"/>
              <line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <line x1="3" y1="10" x2="21" y2="10" stroke="currentColor" stroke-width="2"/>
            </svg>
          </div>
          <span>Upcoming</span>
        </div>
        <button class="add-card-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <line x1="12" y1="5" x2="12" y2="19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <div class="kanban-cards">
        <div class="kanban-card">
          <div class="card-header">
            <h3>MVTY Dham Web</h3>
            <span class="card-date">17/12/25</span>
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
              <span class="task-count">0/4</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- In Processing Column -->
    <div class="kanban-column processing">
      <div class="column-header">
        <div class="column-title">
          <div class="column-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" fill="none"/>
            </svg>
          </div>
          <span>In Processing</span>
        </div>
        <button class="add-card-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <line x1="12" y1="5" x2="12" y2="19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <div class="kanban-cards">
        <div class="kanban-card">
          <div class="card-header">
            <h3>MVTY Dham Web</h3>
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
              <span class="task-count">0/4</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
        
        <div class="kanban-card">
          <div class="card-header">
            <h3>NABL Software</h3>
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
              <span class="task-count">5/22</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
        
        <div class="kanban-card">
          <div class="card-header">
            <h3>Social Media POST</h3>
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
              <span class="task-count">5/22</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
        
        <div class="kanban-card">
          <div class="card-header">
            <h3>Social Media POST</h3>
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
              <span class="task-count">5/22</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- In Review Column -->
    <div class="kanban-column review">
      <div class="column-header">
        <div class="column-title">
          <div class="column-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M9 11l3 3L22 4" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span>In Review</span>
        </div>
        <button class="add-card-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <line x1="12" y1="5" x2="12" y2="19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <div class="kanban-cards">
        <div class="kanban-card">
          <div class="card-header">
            <h3>MVTY Dham Web</h3>
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
              <span class="task-count">0/4</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
        
        <div class="kanban-card">
          <div class="card-header">
            <h3>Chitri Software</h3>
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
              <span class="task-count">5/22</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
        
        <div class="kanban-card">
          <div class="card-header">
            <h3>Om Her Bhole App</h3>
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
              <span class="task-count">12/17</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Completed Column -->
    <div class="kanban-column completed">
      <div class="column-header">
        <div class="column-title">
          <div class="column-icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
              <polyline points="22,4 12,14.01 9,11.01" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span>Completed</span>
        </div>
        <button class="add-card-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <line x1="12" y1="5" x2="12" y2="19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <div class="kanban-cards">
        <div class="kanban-card">
          <div class="card-header">
            <h3>MVTY Dham App</h3>
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
              <span class="task-count">4/4</span>
            </div>
            <div class="card-avatars">
              <div class="avatar" style="background: #4F46E5;">M</div>
              <div class="avatar" style="background: #059669;">D</div>
              <div class="avatar" style="background: #DC2626;">P</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
