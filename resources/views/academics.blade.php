<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academics Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>


  @include('nav')

            <!-- hero section start -->
          <section class="hero-section-academics">
            <div class="container">
                <div class="intro-text1">
                    <p class="lead-1" style="font-size: xx-large;color: #FF7300;"> Empowering Minds, Shaping Futures</p>
                    <p class="lead-2" style="font-size: x-large">Welcome to our vibrant academic community where excellence in teaching, learning, and research comes together to create transformative educational experiences.</p>
                </div>
                <button class="butn">Explore Programs</button>
            </div>
          </section>
          <!-- hero section end -->

          <!-- Undergraduate Degrees Start -->
           <div class="container mt-5" id="pro">
            <h2 class="text-center" style="color: #FF7300;">Programs Offered</h2>
        <div class="container my-5 border p-4 shadow-sm bg-white">

                <h2 class="fw-bold text-orange mb-4">Undergraduate Degrees</h2>
                <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark custom-header">
                    <tr>
                        <th scope="col">Program Name</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($undergraduateDegrees as $degree)
                    <tr>
                        <td class="fw-bold" style="color: #6C3428;">{{ $degree->degree_name }}</td>
                        <td class="fw-bold" style="color: #6C3428;">{{ $degree->duration->length }} Years</td>
                        <td class="fw-bold text-orange">
                            <a href="#majors" class="text-decoration-none">View Specializations</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">No undergraduate degrees available</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
            </div>
           </div>

            <!-- Undergraduate Degrees End -->

             <!-- Master's Degrees and Doctoral Programs Start  -->
            <div class="container  my-5 border p-4 shadow-sm bg-white ">
                <h2 style="font-weight: bold; color: #ff7300;">Master's Degrees</h2>
                <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark custom-header">
                    <tr>
                        <th scope="col">Program Name</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Format</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($mastersDegrees as $degree)
                    <tr>
                        <td class="fw-bold" style="color: #6C3428;">{{ $degree->degree_name }}</td>
                        <td class="fw-bold" style="color: #6C3428;">{{ $degree->duration->length }} Years</td>
                        <td class="fw-bold" style="color: #6C3428;">Full–time/Part–time</td>
                        <td class="fw-bold text-orange">
                            <a href="#majors" class="text-decoration-none">Concentrations</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No master's degrees available</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                </div>

                <!-- Doctoral Degrees -->
                <h2 class="mt-5" style="font-weight: bold; color: #ff7300;">Doctoral Degrees (PhD)</h2>
                <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark custom-header">
                    <tr>
                        <th scope="col">Program Name</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Format</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($doctoralDegrees as $degree)
                    <tr>
                        <td class="fw-bold" style="color: #6C3428;">{{ $degree->degree_name }}</td>
                        <td class="fw-bold" style="color: #6C3428;">{{ $degree->duration->length }} Years</td>
                        <td class="fw-bold" style="color: #6C3428;">Research-based</td>
                        <td class="fw-bold text-orange">
                            <a href="#majors" class="text-decoration-none">Faculty Supervisors</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No doctoral degrees available</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                </div>

                <!-- Postgraduate Degrees -->
                <h2 class="mt-5" style="font-weight: bold; color: #ff7300;">Postgraduate Degrees</h2>
                <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark custom-header">
                    <tr>
                        <th scope="col">Program Name</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Format</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($postgraduateDegrees as $degree)
                    <tr>
                        <td class="fw-bold" style="color: #6C3428;">{{ $degree->degree_name }}</td>
                        <td class="fw-bold" style="color: #6C3428;">{{ $degree->duration->length }} Years</td>
                        <td class="fw-bold" style="color: #6C3428;">Full–time/Part–time</td>
                        <td class="fw-bold text-orange">
                            <a href="#majors" class="text-decoration-none">Advanced Studies</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No postgraduate degrees available</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
             <!-- Master's Degrees and Doctoral Programs End -->

        <!-- Majors Section -->
        <section class="section section-alt" id="majors">
        <div class="container">
            <h2 style="color: #6C3428;">Majors and Specializations</h2>
            <p style="color: #6C3428;">Explore the various majors and specializations offered by our departments.</p>

            <div class="row g-4 mt-4">
            @forelse($majors as $major)
            <div class="col-md-6 col-lg-4">
                <div class="resource-card">
                <h4 style="color: #6C3428;">{{ $major->major_name }}</h4>
                <p style="color: #6C3428;">Department: {{ $major->department->department_name }}</p>
                <a href="#" class="view-more">Learn More →</a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center">No majors available</p>
            </div>
            @endforelse
            </div>
        </div>
        </section>

        <!-- Academic Resources -->
        <section class="section">
        <div class="container">
            <h2  style="color: #6C3428;">Academic Resources</h2>
            <p style="color: #6C3428;">Essential resources to support your academic journey.</p>

            <div class="row g-4 mt-4">
            <div class="col-md-6 col-lg-3">
                <div class="resource-card">
                <h4 style="color: #6C3428;">Course Catalog</h4>
                <p style="color: #6C3428;">Complete listing of all courses offered across all programs and faculties.</p>
                <a href="#" class="view-more">Access Catalog →</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="resource-card">
                <h4 style="color: #6C3428;">Academic Calendar</h4>
                <p style="color: #6C3428;">Important dates, deadlines, and events for the current academic year.</p>
                <a href="#" class="view-more">View Calendar →</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="resource-card">
                <h4 style="color: #6C3428;">Examination Info</h4>
                <p style="color: #6C3428;">Schedules, policies, and resources for midterm and final examinations.</p>
                <a href="#" class="view-more">Learn More →</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="resource-card">
                <h4 style="color: #6C3428;">Scholarships & Financial Aid</h4>
                <p style="color: #6C3428;">Information about funding opportunities, grants, and financial support.</p>
                <a href="#" class="view-more">Explore Options →</a>
                </div>
            </div>
            </div>
        </div>
        </section>

        <!-- Student Support & Guidance -->
        <section class="section">
        <div class="container">
            <h2 style="color: #6C3428;">Student Support & Guidance</h2>
            <p style="color: #6C3428;">We provide comprehensive support services to help you succeed in your academic journey.</p>

            <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="support-card">
                <h4 style="color: #6C3428;">Academic Advising</h4>
                <p style="color: #6C3428;">Personalized guidance on course selection, degree requirements, and academic planning.</p>
                <a href="#" class="view-more">Learn More →</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="support-card">
                <h4 style="color: #6C3428;">Tutoring Services</h4>
                <p style="color: #6C3428;">Free peer tutoring and academic support for challenging courses across all disciplines.</p>
                <a href="#" class="view-more">Find Help →</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="support-card">
                <h4 style="color: #6C3428;">Career Guidance</h4>
                <p style="color: #6C3428;">Career counseling, internship placement, and job search support services.</p>
                <a href="#" class="view-more">Explore Services →</a>
                </div>
            </div>
            </div>
        </div>
        </section>

        <!-- Global Opportunities -->
        <section class="section section-alt">
        <div class="container">
            <h2 style="color: #6C3428;">Global Opportunities</h2>
            <p style="color: #6C3428;">Expand your horizons through our international programs and partnerships.</p>

            <div class="row g-4 mt-4">
            <div class="col-md-6">
                <div class="resource-card">
                <h4 style="color: #6C3428;">Study Abroad</h4>
                <p style="color: #6C3428;">Semester or year-long exchange programs with 100+ partner universities worldwide.</p>
                <a href="#" class="view-more">Explore Programs →</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="resource-card">
                <h4 style="color: #6C3428;">International Partnerships</h4>
                <p style="color: #6C3428;">Dual-degree programs and collaborative research opportunities with global institutions.</p>
                <a href="#" class="view-more">View Partners →</a>
                </div>
            </div>
            </div>
        </div>
        </section>

        <!-- Resources & Downloads -->
        <section class="section">
        <div class="container">
            <h2 style="color: #6C3428;">Resources & Downloads</h2>
            <p style="color: #6C3428;">Access important documents and forms for your academic needs.</p>

            <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="download-card">
                <div class="download-icon"><i class="fas fa-book"></i></div>
                <div>
                    <h5 style="color: #6C3428;">Course Brochures</h5>
                    <a href="#" class="view-more">Download PDF →</a>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="download-card">
                <div class="download-icon"><i class="fas fa-calendar"></i></div>
                <div>
                    <h5 style="color: #6C3428;">Timetables</h5>
                    <a href="#" class="view-more">Download →</a>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="download-card">
                <div class="download-icon"><i class="fas fa-clipboard"></i></div>
                <div>
                    <h5 style="color: #6C3428;">Academic Policies</h5>
                    <a href="#" class="view-more">View Handbook →</a>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>

@include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
