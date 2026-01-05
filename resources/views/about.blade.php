<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Page</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('nav')

<!-- Our Story -->
<section id="story" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4" style="color:#6c3428;">
                    <i class="fas fa-graduation-cap me-2" style="color:#FF7300;"></i>
                    Our Story
                </h2>
                <p style="color:#6c3428;">
                    Hello and welcome to the Pyinnyar Pankhin University website. At the UOPP, a Secular school, we are passionate about inspiring all our students to reach their full potential and develop into well-rounded individuals who are equipped for their onward journey into further education at college or university, employment or training. At present, this site is mainly about information regarding our vision, acknowledging those who have enabled this to happen, and news about forthcoming events, etc. As the site continues to progress, we will be adding lots of more features, which will include a picture gallery, a students section for displaying their creations in the various genres they enjoy (art, fashion, poetry etc.) and a parents section, where we hope to encourage adults to become actively involved alongside their children. As the UOPP is a ‘Free’ school, it is only through the tireless work of the all the volunteers and the donations of benefactors, that it continues to operate. The outstanding work and dedication of the Venerable Neminda, encourages us all. “All growth depends upon activity. There is no development physically or intellectually without effort, and effort means work.”
                </p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/images/Hero_section image.jpg') }}"
                     alt="University History"
                     class="img-fluid rounded shadow"
                     loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section id="mission" class="py-5 bg-light">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="card-title" style="color:#6c3428;">
                            <i class="fas fa-eye me-2" style="color:#FF7300;"></i>
                            Vision
                        </h3>
                        <p class="card-text" style="color:#6c3428;">
                            "By confidence, one crosses the torrent."
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="card-title" style="color:#6c3428;">
                            <i class="fas fa-bullseye me-2" style="color:#FF7300;"></i>
                            Mission
                        </h3>
                        <p class="card-text" style="color:#6c3428;">
Curiosity, and withoutness.                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Core Values -->
<section id="values" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5" style="color:#6c3428;">
            <i class="fas fa-university me-2" style="color:#FF7300;"></i>
            Core Values
        </h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-shield-alt fa-3x mb-3" style="color:#FF7300;"></i>
                        <h5 style="color:#6c3428;">Integrity</h5>
                        <p style="color:#6c3428;">Ethical conduct in all endeavors.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-award fa-3x mb-3" style="color:#FF7300;"></i>
                        <h5 style="color:#6c3428;">Excellence</h5>
                        <p style="color:#6c3428;">Commitment to the highest standards.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-users fa-3x mb-3" style="color:#FF7300;"></i>
                        <h5 style="color:#6c3428;">Inclusivity</h5>
                        <p style="color:#6c3428;">A diverse and welcoming community.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Campus & Facilities -->
<section id="campus" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5" style="color:#6c3428;">
            <i class="fas fa-map-marked-alt me-2" style="color:#FF7300;"></i>
            Campus & Facilities
        </h2>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ asset('assets/images/in library 1.jpg') }}"
                         class="card-img-top"
                         alt="Campus Library"
                         loading="lazy">
                    <div class="card-body">
                        <h5 style="color:#6c3428;">State-of-the-Art Library</h5>
                        <p style="color:#6c3428;">Over 2 million resources and 24/7 study spaces.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/BmYv8XGl-YU"
                                title="Virtual Campus Tour"
                                allowfullscreen></iframe>
                    </div>
                    <div class="card-body">
                        <h5 style="color:#6c3428;">Virtual Campus Tour</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
