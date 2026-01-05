<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

@include('nav')

       <!-- Hero Section Start -->
         <section class="hero-section-event text-center">
            <div class="hero-content">
                <div class="intro-text-event">
                <p class="lead-1">Stay Updated with Campus Life</p>
                <p class="lead-2">
                    Discover upcoming events, academic conferences, workshops, and student activities.
                </p>
                </div>
                <div class="search-container">
                <div class="input-group mb-3 justify-content-center">
                    <input type="text" class="form-control" placeholder="Search events..." />
                    <button class="btn btn-secondary-custom" type="button">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </div>
        </section>
<!-- Hero Section End -->

    <!-- Main Content -->
     <div class="container">
    <div class="container-event mb-5 mt-5">
        <!-- Upcoming Events -->
        <section class="mb-5">
            <h2 class="section-title-event" style="color: #6C3428;">Upcoming Events</h2>

            <div class="row">
                @forelse($upcomingEvents as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card event-card">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/default-event.jpg') }}" class="card-img-top" alt="{{ $event->title }}">
                        <div class="card-body">
                            <span class="category-tag lecture-tag" style="color: #6C3428;">
                                <i class="fas fa-calendar me-1" style="color: #6C3428;"></i> Event
                            </span>
                            <h5 style="color: #6C3428;">{{ $event->title }}</h5>
                            <p style="color: #6C3428;">
                                <i class="far fa-calendar-alt me-1"></i> {{ $event->event_date->format('M d, Y') }} | {{ $event->event_time->format('g:i A') }}
                                <br>
                                <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}
                            </p>
                            <p style="color: #6C3428;">{{ Str::limit($event->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-sm mt-2" style="border-radius: 10px; color: white; background-color: #6C3428 ;">Register</button>
                                <small class="text-muted">Limited spots</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center text-muted">No upcoming events at this time.</p>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-secondary-custom" style="border-radius: 10px; color: white; background-color: #FF7300;">View All Upcoming Events</button>
            </div>
        </section>

        <!-- Featured Events start-->
        <section class="mb-5">
            <h2 class="section-title">Featured Events</h2>

            <div class="row">
                @forelse($featuredEvents as $index => $event)
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 featured-event">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/default-event.jpg') }}" class="img-fluid rounded-start h-100" alt="{{ $event->title }}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <span class="badge bg-warning mb-2" style="color: #6C3428;">Featured</span>
                                    <h4 style="color: #6C3428;">{{ $event->title }}</h4>
                                    <p style="color: #6C3428;">
                                        <i class="far fa-calendar-alt me-1"></i> {{ $event->event_date->format('M d, Y') }} | {{ $event->event_time->format('g:i A') }}
                                        <br>
                                        <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}
                                    </p>
                                    <p style="color: #6C3428;">{{ Str::limit($event->description, 120) }}</p>
                                    <button class="btn btn-secondary-custom" style="border-radius: 10px; color: white; background-color: #FF7300;">Details & RSVP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center text-muted">No featured events available at this time.</p>
                </div>
                @endforelse
            </div>
        </section>
        <!-- Featured Events End -->

        <!-- Calendar View start-->
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title mb-0">Calendar View</h2>
                <div>
                    <button class="btn btn-outline-secondary btn-sm me-2" onclick="previousMonth()"><i class="fas fa-chevron-left"></i></button>
                    <span class="fw-bold" id="currentMonth">{{ now()->format('F Y') }}</span>
                    <button class="btn btn-outline-secondary btn-sm ms-2" onclick="nextMonth()"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Sun</th>
                                    <th scope="col">Mon</th>
                                    <th scope="col">Tue</th>
                                    <th scope="col">Wed</th>
                                    <th scope="col">Thu</th>
                                    <th scope="col">Fri</th>
                                    <th scope="col">Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentDate = now()->startOfMonth();
                                    $endOfMonth = now()->endOfMonth();
                                    $startOfCalendar = $currentDate->copy()->startOfWeek();
                                    $endOfCalendar = $endOfMonth->copy()->endOfWeek();

                                    $calendarData = [];
                                    if($calendarEvents) {
                                        foreach($calendarEvents as $date => $events) {
                                            $calendarData[$date] = count($events);
                                        }
                                    }

                                    $calendarDates = [];
                                    for($date = $startOfCalendar->copy(); $date->lte($endOfCalendar); $date->addDay()) {
                                        $calendarDates[] = $date->copy();
                                    }
                                @endphp

                                @foreach($calendarDates as $index => $date)
                                    @if($date->dayOfWeek == 0 && $index > 0)
                                        </tr><tr>
                                    @endif

                                    @php
                                        $dateString = $date->format('Y-m-d');
                                        $isCurrentMonth = $date->month == now()->month;
                                        $hasEvents = isset($calendarData[$dateString]);
                                        $eventCount = $hasEvents ? $calendarData[$dateString] : 0;
                                    @endphp

                                    <td class="{{ !$isCurrentMonth ? 'text-muted' : '' }}">
                                        @if($isCurrentMonth)
                                            @if($hasEvents)
                                                <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <div class="calendar-highlight" style="background-color: #FF7300; border: 2px; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                        {{ $date->day }}
                                                    </div>
                                                    <small class="text-muted">{{ $eventCount }} {{ $eventCount == 1 ? 'event' : 'events' }}</small>
                                                </div>
                                            @else
                                                {{ $date->day }}
                                            @endif
                                        @else
                                            {{ $date->day }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    @if(!$calendarEvents || $calendarEvents->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <p>No events scheduled for this month.</p>
                        </div>
                    @else
                        <div class="mt-3">
                            <h6 class="text-muted">This Month's Events:</h6>
                            <div class="row">
                                @foreach($calendarEvents->take(3) as $date => $events)
                                    <div class="col-md-4 mb-2">
                                        <small class="text-muted">
                                            <strong>{{ \Carbon\Carbon::parse($date)->format('M d') }}:</strong>
                                            {{ $events->count() }} {{ $events->count() == 1 ? 'event' : 'events' }}
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- Calendar View End -->
        <!-- Past Events / Archives -->
         <div class="container mt-5 mb-5">

                <ul class="nav nav-pills mb-4" id="pastEventsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="past-events-tab" data-bs-toggle="pill" data-bs-target="#past-events" type="button" role="tab">Past Events</button>
                </li>
            </ul>

            <div class="row">
                @forelse($pastEvents as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card event-card">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/default-event.jpg') }}" class="card-img-top" alt="{{ $event->title }}">
                        <div class="card-body">
                            <span class="category-tag lecture-tag" style="color: #6C3428;">
                                <i class="fas fa-calendar me-1" style="color: #6C3428;"></i> Event
                            </span>
                            <h5 style="color: #6C3428;">{{ $event->title }}</h5>
                            <p style="color: #6C3428;">
                                <i class="far fa-calendar-alt me-1"></i> {{ $event->event_date->format('M d, Y') }} | {{ $event->event_time->format('g:i A') }}
                                <br>
                                <i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}
                            </p>
                            <p style="color: #6C3428;">{{ Str::limit($event->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-sm mt-2" style="border-radius: 10px; color: white; background-color: #6C3428 ;">View Photos</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center text-muted">No past events available.</p>
                </div>
                @endforelse
            </div>
        </div>
        </div>
        </div>
        <!-- Past Events / Archives -->

@include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <script>
        let currentDate = new Date();

        function updateCalendar(monthOffset = 0) {
            currentDate.setMonth(currentDate.getMonth() + monthOffset);
            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"];

            document.getElementById('currentMonth').textContent =
                monthNames[currentDate.getMonth()] + ' ' + currentDate.getFullYear();

            // In a real implementation, you would make an AJAX call to fetch events for the new month
            // For now, we'll just update the display
            console.log('Calendar updated for:', currentDate.toISOString().substring(0, 7));
        }

        function previousMonth() {
            updateCalendar(-1);
        }

        function nextMonth() {
            updateCalendar(1);
        }

        // Initialize calendar
        updateCalendar(0);
    </script>
</body>
</html>
