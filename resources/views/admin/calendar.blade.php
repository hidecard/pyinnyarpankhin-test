@extends('admin.layout')

@section('title', 'Academic Calendar')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-calendar-alt me-2"></i>Academic Calendar
        </h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Event
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Calendar Section -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Calendar View</h6>
                    <div class="calendar-nav">
                        <button id="prev-month" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <h5 class="mb-0 mx-3" id="calendar-title"></h5>
                        <button id="next-month" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="calendar" class="calendar-grid"></div>
                </div>
            </div>
        </div>

        <!-- Events Sidebar -->
        <div class="col-lg-4">
            <!-- Upcoming Events -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="fas fa-clock me-2"></i>Upcoming Events
                    </h6>
                </div>
                <div class="card-body">
                    @php
                        $upcomingEvents = $events->filter(function($event) {
                            return $event->event_date->isFuture() || $event->event_date->isToday();
                        })->take(5);
                    @endphp

                    @if($upcomingEvents->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($upcomingEvents as $event)
                                <div class="list-group-item px-0">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div>
                                            <h6 class="mb-1">
                                                <a href="{{ route('admin.events.show', $event) }}" class="text-decoration-none">
                                                    {{ $event->title }}
                                                </a>
                                            </h6>
                                            <p class="mb-1 small text-muted">
                                                <i class="fas fa-calendar me-1"></i>{{ $event->event_date->format('M j, Y') }}
                                                <i class="fas fa-clock ms-2 me-1"></i>{{ $event->event_time }}
                                            </p>
                                            <small class="text-muted">{{ $event->location }}</small>
                                        </div>
                                        <small class="text-muted">
                                            @if($event->event_date->isToday())
                                                <span class="badge badge-active">Today</span>
                                            @elseif($event->event_date->diffInDays() == 1)
                                                <span class="badge badge-pending">Tomorrow</span>
                                            @else
                                                {{ $event->event_date->diffForHumans() }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No upcoming events</p>
                            <a href="{{ route('admin.events.create') }}" class="btn btn-sm btn-primary">Create Event</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">
                        <i class="fas fa-chart-bar me-2"></i>Event Statistics
                    </h6>
                </div>
                <div class="card-body">
                    @php
                        $totalEvents = $events->count();
                        $activeEvents = $events->where('is_active', true)->count();
                        $upcomingCount = $events->filter(function($event) {
                            return $event->event_date->isFuture() || $event->event_date->isToday();
                        })->count();
                        $pastEvents = $events->filter(function($event) {
                            return $event->event_date->isPast();
                        })->count();
                    @endphp

                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="h4 mb-0 text-primary">{{ $totalEvents }}</div>
                            <small class="text-muted">Total Events</small>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="h4 mb-0 text-success">{{ $activeEvents }}</div>
                            <small class="text-muted">Active</small>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="h4 mb-0 text-info">{{ $upcomingCount }}</div>
                            <small class="text-muted">Upcoming</small>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="h4 mb-0 text-secondary">{{ $pastEvents }}</div>
                            <small class="text-muted">Past</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>Manage All Events
                        </a>
                        <a href="{{ route('admin.events.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus me-2"></i>Create New Event
                        </a>
                        <button class="btn btn-outline-info" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>Print Calendar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Details Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="eventModalBody">
                <!-- Event details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="viewEventBtn" class="btn btn-primary">View Full Details</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    background: #dee2e6;
    border: 1px solid #dee2e6;
}

.calendar-day {
    background: white;
    min-height: 120px;
    padding: 5px;
    position: relative;
}

.calendar-day-header {
    background: #f8f9fc;
    padding: 8px;
    font-weight: 600;
    color: #495057;
    text-align: center;
    border-bottom: 1px solid #dee2e6;
}

.calendar-day.today {
    background: #fff3cd;
}

.calendar-day.other-month {
    background: #f8f9fc;
    color: #adb5bd;
}

.calendar-day.has-events {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    border: 2px solid #2196f3;
    box-shadow: 0 2px 4px rgba(33, 150, 243, 0.2);
}

.calendar-day.has-events.today {
    background: linear-gradient(135deg, #fff3cd 0%, #ffe082 100%);
    border: 2px solid #ff9800;
    box-shadow: 0 2px 4px rgba(255, 152, 0, 0.3);
}

.event-item {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2px 4px;
    margin-bottom: 2px;
    border-radius: 3px;
    font-size: 0.75rem;
    cursor: pointer;
    text-decoration: none;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.event-item:hover {
    opacity: 0.8;
    color: white;
}

.event-item.upcoming {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.event-item.today {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: #212529;
}

.event-item.past {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
}

.calendar-nav {
    display: flex;
    align-items: center;
}

.list-group-item {
    border: none;
    border-bottom: 1px solid #f1f3f4;
}

.list-group-item:last-child {
    border-bottom: none;
}

@media print {
    .btn, .card-header .calendar-nav, .modal {
        display: none !important;
    }

    .calendar-grid {
        page-break-inside: avoid;
    }

    .calendar-day {
        break-inside: avoid;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentDate = new Date();
    const events = @json($events);

    function renderCalendar() {
        const calendar = document.getElementById('calendar');
        const title = document.getElementById('calendar-title');

        // Set title
        title.textContent = currentDate.toLocaleDateString('en-US', {
            month: 'long',
            year: 'numeric'
        });

        // Clear calendar
        calendar.innerHTML = '';

        // Add day headers
        const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        days.forEach(day => {
            const header = document.createElement('div');
            header.className = 'calendar-day-header';
            header.textContent = day;
            calendar.appendChild(header);
        });

        // Get calendar data
        const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        const startDate = new Date(firstDay);
        startDate.setDate(startDate.getDate() - firstDay.getDay());

        // Render 6 weeks
        for (let i = 0; i < 42; i++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'calendar-day';

            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i);

            // Add day number
            const dayNumber = document.createElement('div');
            dayNumber.className = 'fw-bold mb-1';
            dayNumber.textContent = date.getDate();

            // Highlight today
            if (date.toDateString() === new Date().toDateString()) {
                dayDiv.classList.add('today');
            }

            // Mark other months
            if (date.getMonth() !== currentDate.getMonth()) {
                dayDiv.classList.add('other-month');
            }

            dayDiv.appendChild(dayNumber);

            // Add events for this day
            const dayEvents = events.filter(event => {
                const eventDate = new Date(event.event_date);
                return eventDate.toDateString() === date.toDateString();
            });

            // Highlight days with events
            if (dayEvents.length > 0) {
                dayDiv.classList.add('has-events');
            }

            dayEvents.forEach(event => {
                const eventDiv = document.createElement('a');
                eventDiv.className = 'event-item';
                eventDiv.textContent = event.title;
                eventDiv.href = '#';
                eventDiv.onclick = (e) => {
                    e.preventDefault();
                    showEventModal(event);
                };

                // Add status classes
                const eventDate = new Date(event.event_date);
                if (eventDate < new Date() && !eventDate.toDateString() === new Date().toDateString()) {
                    eventDiv.classList.add('past');
                } else if (eventDate.toDateString() === new Date().toDateString()) {
                    eventDiv.classList.add('today');
                } else {
                    eventDiv.classList.add('upcoming');
                }

                dayDiv.appendChild(eventDiv);
            });

            calendar.appendChild(dayDiv);
        }
    }

    function showEventModal(event) {
        const modal = new bootstrap.Modal(document.getElementById('eventModal'));
        const modalBody = document.getElementById('eventModalBody');
        const viewBtn = document.getElementById('viewEventBtn');

        modalBody.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    ${event.image ? `<img src="/storage/${event.image}" class="img-fluid rounded mb-3" alt="${event.title}">` : ''}
                </div>
                <div class="col-md-8">
                    <h4>${event.title}</h4>
                    <p><strong>Date:</strong> ${new Date(event.event_date).toLocaleDateString()}</p>
                    <p><strong>Time:</strong> ${event.event_time}</p>
                    <p><strong>Location:</strong> ${event.location}</p>
                    <p><strong>Status:</strong> <span class="badge ${event.is_active ? 'badge-active' : 'badge-inactive'}">${event.is_active ? 'Active' : 'Inactive'}</span></p>
                    <p><strong>Description:</strong></p>
                    <p>${event.description}</p>
                </div>
            </div>
        `;

        viewBtn.href = `/admin/events/${event.id}`;

        modal.show();
    }

    // Navigation
    document.getElementById('prev-month').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('next-month').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    // Initial render
    renderCalendar();
});
</script>
@endpush
