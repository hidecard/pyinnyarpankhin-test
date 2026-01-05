<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
@include('nav')

         <!-- hero section start -->
          <section class="hero-section">
            <div class="container">
                <div class="intro-text">
                    <p class="lead-1" style="font-size: xx-large;">To provide each student with the knowledge and skills to reach their individual potential to make positive contributions to Myanmar and the world wide</p>
                    <p class="lead-2" style="font-size: x-large;">Explore our programs, research, and vibrant student life.</p>
                </div>
                <button class="btn1"><i class="fas fa-graduation-cap"></i><a style="text-decoration: none; color: #FF7300;" href="{{ route('admissions') }}"> Apply Now</a> </button>
                <button class="btn2"><i class="fas fa-book"></i> <a style="text-decoration: none; color: white" href="{{ route('academics') }}">Explore Programs</a> </button>
            </div>
          </section>
          <!-- hero section end -->

          <!-- Section 2 start -->
            <section class="section-2 mt-5">
            <div class="container">
            <h2 style="color: #6C3428;">Latest News & Announcements</h2>
            <div class="announcement-container">
                @forelse($news as $item)
                <div class="box">
                    <h5 style="color: #FF7300;">{{ $item->title }}</h5>
                    <p>{{ Str::limit($item->content, 100) }}</p>
                    <small>{{ $item->published_date }}</small>
                </div>
                @empty
                <div class="box">Admissions Open for 2025</div>
                <div class="box">Library System Updated</div>
                <div class="box">Upcoming Convocation Ceremony</div>
                @endforelse
            </div>
            </div>
        </section>
           <!-- Section 2 end -->

            <!-- Section 3 start -->
            <section class="section-3 text-center">
                <div class=" mx-auto">
                <img src="{{ asset('assets/images/Person 1.jpg') }}" class="person" alt="#">
                <h3 class="mt-3" style="color: #6C3428;">Welcome from the President</h3>
                <p class="mt-2 m-5 p-5">Pyinnyar Pankhin welcomes you!
Beneath the shelter of a grand, leafy tree, we remember its humble beginning—a single seed, quietly nurturing promise. Gazing up at towering skyscrapers, we recognize that every marvel rises from a simple foundation. Pyinnyar Pankhin stands as your steadfast base, inviting you to cultivate your potential and embrace the fleeting beauty of growth. Like the shade of a generous tree, our discovery is meant to enrich your family, your community, and the tapestry of humanity. With open arms, Pyinnyar Pankhin welcomes you—where your journey becomes our inspiration, and your triumph, our shared dream.</p>
                </div>
            </section>
             <!-- Section 3 end -->

            <!-- Section cart start -->
               <div class="section-cart text-center">
    <div class="sc-cart" onclick="location.href='{{ route('academics') }}'">
        <i class="fas fa-book-open"></i> Academics
    </div>

    <div class="sc-cart" onclick="location.href='{{ route('department') }}'">
        <i class="fas fa-school"></i> Departments
    </div>

    <div class="sc-cart" onclick="location.href='{{ route('library') }}'">
        <i class="fas fa-book"></i> Library
    </div>

    <div class="sc-cart" onclick="location.href='{{ route('admissions') }}'">
        <i class="fas fa-clipboard"></i> Admissions
    </div>

    <div class="sc-cart" onclick="location.href='{{ route('event') }}'">
        <i class="fas fa-calendar-check"></i> Events
    </div>

    <div class="sc-cart" onclick="location.href='{{ route('department') }}'">
        <i class="fas fa-chalkboard-teacher"></i> Faculty
    </div>
</div>

             <!-- Section cart end  -->

      <!-- Featured Programs start -->
            <section class="featured-programs container mt-5">
                <div class="d-flex align-items-center mb-4">
                    <h3 style="color: #6C3428; margin-right: 20px;">Featured Programs</h3>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <div class="card" style="width: 400px; border: 1px solid #6C3428; border-radius: 10px;">
                        <img src="{{ asset('assets/images/Computer Science students.webp') }}" class="card-img-top" alt="Computer Science">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #FF7300;">Computer Science</h5>
                            <p class="card-text" style="color: #6C3428;">Discover the world of software, AI, and data science with our hands-on learning experience.</p>
                        </div>
                    </div>

                    <div class="card" style="width: 400px; border: 1px solid #6C3428; border-radius: 10px;">
                        <img src="{{ asset('assets/images/Psychology students.webp') }}" class="card-img-top" alt="Psychology">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #FF7300;">Psychology</h5>
                            <p class="card-text" style="color: #6C3428;">Advance your understanding of human behavior through cutting-edge psychological research and expert faculty guidance.</p>
                        </div>
                    </div>

                    <div class="card" style="width: 400px; border: 1px solid #6C3428; border-radius: 10px;">
                        <img src="{{ asset('assets/images/Business Administration students.jpg') }}" class="card-img-top" alt="Business Administration">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #FF7300;">Business Administration</h5>
                            <p class="card-text" style="color: #6C3428;">Develop strategic thinking and leadership skills for a successful business career.</p>
                        </div>
                    </div>
                </div>
            </section>
        <!-- Featured Programs end -->

         <!-- Student Life & Testimonials Start -->
            <section class="container my-5">
                <h3 class="text-center mb-4" style="color: #6C3428; font-weight: bold;">
                    Student Life & Testimonials
                </h3>

                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <div class="testimonial-box">
                        <p class="quote">"My experience here has been life-changing. I gained knowledge and lifelong friends."</p>
                        <p class="author" style="color: #6C3428;">– Aye Chan, Class of 2024</p>
                    </div>

                    <div class="testimonial-box">
                        <p class="quote">"Supportive faculty and exciting campus life made learning enjoyable every day."</p>
                        <p class="author" style="color: #6C3428;">– Ko Ko, Alumni</p>
                    </div>
                </div>
            </section>
        <!-- Student Life & Testimonials End -->

           <!-- Upcoming Events Start  -->
            <section class="upcoming-events">
                <div class="container">
                    <h2 class="events-title">Upcoming Events</h2>
                    <div class="row">
                    @forelse($events as $event)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card event-card">
                            <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('assets/images/default-event.jpg') }}" class="card-img-top" alt="{{ $event->title }}">
                            <div class="card-body">
                                <span class="category-tag" style="color: #6C3428;">
                                    <i class="fas fa-calendar-check me-1" style="color: #6C3428;"></i> Event
                                </span>
                                <h5 style="color: #6C3428;">{{ $event->title }}</h5>
                                <p style="color: #6C3428;">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $event->event_date }}
                                    <br>
                                    <i class="fas fa-map-marker-alt me-1"></i> Main Campus
                                </p>
                                <p style="color: #6C3428;">{{ $event->description ?? 'Join us for this exciting university event.' }}</p>
                                <button class="btn btn-sm mt-2" style="border-radius: 10px; color: white; background-color: #6C3428 ;">More Info</button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card event-card">
                            <img src="{{ asset('assets/image/ceremony university.jpg') }}" class="card-img-top" alt="Convocation Ceremony">
                            <div class="card-body">
                                <span class="category-tag" style="color: #6C3428;">
                                    <i class="fas fa-graduation-cap me-1" style="color: #6C3428;"></i> Ceremony
                                </span>
                                <h5 style="color: #6C3428;">Convocation Ceremony</h5>
                                <p style="color: #6C3428;">
                                    <i class="far fa-calendar-alt me-1"></i> April 12, 2025 | 10:00 AM
                                    <br>
                                    <i class="fas fa-map-marker-alt me-1"></i> University Stadium
                                </p>
                                <p style="color: #6C3428;">Celebrate the achievements of our graduating class. All family and friends welcome.</p>
                                <button class="btn btn-sm mt-2" style="border-radius: 10px; color: white; background-color: #6C3428 ;">RSVP</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card event-card">
                            <img src="{{ asset('assets/image/college students.jpg') }}" class="card-img-top" alt="Science Expo">
                            <div class="card-body">
                                <span class="category-tag" style="color: #6C3428;">
                                    <i class="fas fa-flask me-1" style="color: #6C3428;"></i> Academic
                                </span>
                                <h5 style="color: #6C3428;">Science Expo</h5>
                                <p style="color: #6C3428;">
                                    <i class="far fa-calendar-alt me-1"></i> May 3, 2025 | 9:00 AM - 5:00 PM
                                    <br>
                                    <i class="fas fa-map-marker-alt me-1"></i> Science Building
                                </p>
                                <p style="color: #6C3428;">Annual showcase of student research projects in STEM fields.</p>
                                <button class="btn btn-sm mt-2" style="border-radius: 10px; color: white; background-color: #6C3428 ;">Register</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card event-card">
                            <img src="{{ asset('assets/image/uni events image.png') }}" class="card-img-top" alt="Open Campus Day">
                            <div class="card-body">
                                <span class="category-tag" style="color: #6C3428;">
                                    <i class="fas fa-users me-1" style="color: #6C3428;"></i> Open Day
                                </span>
                                <h5 style="color: #6C3428;">Open Campus Day</h5>
                                <p style="color: #6C3428;">
                                    <i class="far fa-calendar-alt me-1"></i> June 10, 2025 | 9:00 AM - 4:00 PM
                                    <br>
                                    <i class="fas fa-map-marker-alt me-1"></i> Campus-wide
                                </p>
                                <p style="color: #6C3428;">Explore our campus, meet faculty, and learn about our programs.</p>
                                <button class="btn btn-sm mt-2" style="border-radius: 10px; color: white; background-color: #6C3428 ;">More Info</button>
                            </div>
                        </div>
                    </div>
                    @endforelse
                    </div>
                    <div class="view-all">
                    <a href="{{ route('event') }}" class="view-button-link">
                        <button class="view-button">View All Events</button>
                    </a>
                    </div>
                </div>
            </section>
           <!-- Upcoming Events End  -->

        <!-- Stats Section Start -->
        <section class="stats-section">
        <div class="stats-container">
            <div class="stat-box">
            <h3 class="stat-number">10,000+</h3>
            <p>Graduates</p>
            </div>
            <div class="stat-box">
            <h3 class="stat-number">50+</h3>
            <p>Departments</p>
            </div>
            <div class="stat-box">
            <h3 class="stat-number">30+</h3>
            <p>Years of Excellence</p>
            </div>
        </div>
        </section>
        <!-- Stats Section End -->

       <!-- Subscribe Section Start -->
         <section class="subscribe-section">
            <h2 class="subscribe-title">Stay Updated</h2>
            <div class="subscribe-container">
                <input type="email" placeholder="Enter your email" class="subscribe-input">
                <!-- <br> -->
                <button class="subscribe-button">Subscribe</button>
            </div>
        </section>
        <!-- Subscribe Section End  -->

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
