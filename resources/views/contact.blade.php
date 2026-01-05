<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>

@include('nav')
         <!-- Hero Section start-->
              <section class="hero-section-contact text-center">
                <div class="container">
                    <div class="intro-text-contact">
                      <p class="lead-1" style="font-size: xx-large; color: #FF7300;">Get in Touch With Us</p>
                      <p class="lead-2" style="font-size: x-large;">Have questions? We're here to help.</p>
                    </div>
                       <a href="#contact-form"><button class="butnn1"><i class="fas fa-envelope"></i>Send a Message</button></a>
                      <a href="#phone"><button class="butnn2"><i class="fas fa-phone"></i> Contact Info</button></a>
                        </div>
              </section>
          <!-- hero section end -->

        <!-- Contact Information -->
          <div id="phone" class="container mt-5">
            <div class="contact-info-contact">
            <h2 style="color: #6C3428;">Contact Information</h2>
            <div class="row g-4 mt-3">
                <!-- Address Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card contact-info-card h-100">
                        <div class="card-body text-center">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h5 class="card-title" style="color: #6C3428;">Address</h5>
                            <p class="card-text" style="color: #6C3428;">
                              Pyinnyar Pankhin University,<br>
                              Myanaung,<br>
                              Ayeyarwaddy Myanmar
                            </p>
                            <a href="#map" class="btn btn-sm " style="color: white; background-color: #FF7300;">View on Map</a>
                        </div>
                    </div>
                </div>

                <!-- Phone Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card contact-info-card h-100">
                        <div class="card-body text-center">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h5 class="card-title" style="color: #6C3428;">Phone</h5>
                            <p class="card-text" style="color: #6C3428;">
                               (09) 882467881 <br>
                               (09) 456789101  [ Fax ]
                            </p>
                            <a href="tel:+1234567890" class="btn btn-sm " style="color: white; background-color: #FF7300;">Call Now</a>
                        </div>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card contact-info-card h-100">
                        <div class="card-body text-center">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h5 class="card-title" style="color: #6C3428;">Email</h5>
                            <p class="card-text" style="color: #6C3428;">
                               pininyarpankhin@gmail.com<br>
                               uopp@email.com
                            </p>
                            <a href="mailto:info@university.edu" class="btn btn-sm " style="color: white; background-color: #FF7300;">Email Us</a>
                        </div>
                    </div>
                </div>

                <!-- Hours Card -->
                <div class="col-md-6 col-lg-3">
                    <div class="card contact-info-card h-100">
                        <div class="card-body text-center">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h5 class="card-title" style="color: #6C3428;">Working Hours</h5>
                            <p class="card-text" style="color: #6C3428;">
                                Mon–Fri: 9:00 AM – 5:00 PM<br>
                                Sat–Sun: Closed
                            </p>
                            <button class="btn btn-sm" style="color: white; background-color: #FF7300;">Holiday Schedule</button>
                        </div>
                    </div>
                </div>
            </div>
       </div>
            </div>
          </div>
        <!-- Contact information end -->

        <!-- Map Section start-->
         <div class="container mt-5 mb-5" id="map">
            <h2 class="text-center mb-4" style="color: #6C3428;">Our Location</h2>
          <div class="row" style="height: 400px; border-radius: 10px; overflow: hidden;">
         <div class="col-md-12" style="height: 100%;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3788.744135976519!2d95.32630067464636!3d18.26754727685533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c74149ab560691%3A0x8e3ab8b6a14524f7!2sPyinnyar%20Pankhin%20English%20Training%20Center!5e0!3m2!1sen!2smm!4v1748075909563!5m2!1sen!2smm" width="100%" height="100%" style="border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>
          </div>
        </div>
        <!-- Map Section end -->

          <!-- Contact Form start-->
           <div class="contact-form-container container mt-5 mb-5">
            <div class="row">
        <section id="contact-form" class="mb-5">
            <h2 class="section-title" style="color: #FF7300;">Send Us a Message</h2>
                <hr style="color: #FF7300; width: 25%;">
            <div class="row">
                <div class="col-lg-6">
                    <form id="universityContactForm" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold" style="color: #6C3428;">Full Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" required>
                            <div class="invalid-feedback">
                                Please provide your name.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold" style="color: #6C3428;">Email Address</label>
                            <input type="email" class="form-control form-control-lg" id="email" required>
                            <div class="invalid-feedback">
                                Please provide a valid email.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label fw-bold" style="color: #6C3428;">Subject</label>
                            <select class="form-select form-select-lg" id="subject" required>
                                <option value=""  selected disabled style="color: #6C3428;">Select a subject</option>
                                <option value="admissions" style="color: #6C3428;">Admissions Inquiry</option>
                                <option value="academics" style="color: #6C3428;">Academic Programs</option>
                                <option value="financial" style="color: #6C3428;">Financial Aid</option>
                                <option value="campus" style="color: #6C3428;">Campus Life</option>
                                <option value="other" style="color: #6C3428;">Other</option>
                            </select>
                            <div class="invalid-feedback" style="color: #6C3428;">
                                Please select a subject.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold" style="color: #6C3428;">Message</label>
                            <textarea class="form-control form-control-lg" id="message" rows="5" required></textarea>
                            <div class="invalid-feedback" style="color: #6C3428;">
                                Please enter your message.
                            </div>
                        </div>

                        <div class="button">
                            <button type="submit" class="btn-button" >
                                <i class="fas fa-paper-plane me-2"></i> Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <div class=" col-lg-6 mt-4 mt-lg-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title mb-4 fw-bold" style="color: #6C3428;">Frequently Asked Questions</h4>

                            <div class="accordion" id="faqAccordion">
                                <!-- FAQ Item 1 -->
                                <div class="accordion-item mb-3 border-0">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" style="color: #6C3428;">
                                            How do I apply for admission?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body" style="color: #6C3428;">
                                            You can apply through our online portal or download the application form from our website. The admissions office is also available to assist you with the process.
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ Item 2 -->
                                <div class="accordion-item mb-3 border-0">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" style="color: #6C3428;">
                                            What are the office hours for different departments?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body" style="color: #6C3428;">
                                            Most administrative offices are open Monday through Friday from 9:00 AM to 5:00 PM. Some departments may have extended hours during peak periods.
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ Item 3 -->
                                <div class="accordion-item mb-3 border-0">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" style="color: #6C3428;">
                                            Where can I find information about campus tours?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body" style="color: #6C3428;">
                                            Campus tours are available Monday through Saturday. You can schedule a tour through our admissions office or online via the campus visit section of our website.
                                        </div>
                                    </div>
                                </div>

                                <!-- FAQ Item 4 -->
                                <div class="accordion-item mb-3 border-0">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" style="color: #6C3428;">
                                            How can I get in touch with a specific faculty member?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body" style="color: #6C3428;">
                                            Faculty contact information is available in the directory on our website. You can also contact the department office for assistance in reaching specific faculty members.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="asq mt-4">
                                <p class="mb-2" style="color: #6C3428;">Didn't find your answer?</p>
                                <button class="btn-asq mt-2">Ask Your Question</button>
                                <!-- <a href="" class="btn-asq">Ask Your Question</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
           </div>
        <!-- Contact Form end -->

        <!-- Department Contacts Start -->
             <section class="my-5 py-4">
                <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title" style="color: #6C3428;">Department Contacts</h2>
                    <hr style="color: #FF7300; width: 50%; height: 3px; margin: auto;">
                    <p style="color: #6C3428;">Find the right office or department for your specific needs</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Academic Departments -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header text-white" style="background-color: #FF7300;">
                            <h4 class="mb-0"><i class="fas fa-graduation-cap me-2"></i> Academic</h4>
                        </div>
                        <div class="card-body">
                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">Admissions Office</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">admissions@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 778996097</span>
                                </div>
                            </div>

                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">Registrar's Office</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">registrar@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 776998067</span>
                                </div>
                            </div>

                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">Library Services</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">library@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 727698143</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Services -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header text-white" style="background-color: #FF7300;">
                            <h4 class="mb-0"><i class="fas fa-users me-2"></i> Student Services</h4>
                        </div>
                        <div class="card-body">
                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">Student Affairs</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">studentaffairs@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 446796997</span>
                                </div>
                            </div>

                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">Career Services</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">careers@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 441398067</span>
                                </div>
                            </div>

                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">Health Center</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">healthcenter@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 403718143</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Administrative -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header text-white" style="background-color: #FF7300;">
                            <h4 class="mb-0"><i class="fas fa-building me-2"></i> Administrative</h4>
                        </div>
                        <div class="card-body">
                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">Human Resources</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">hr@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 435766097</span>
                                </div>
                            </div>

                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">Finance Office</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">finance@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 447651067</span>
                                </div>
                            </div>

                            <div class="department-card">
                                <h5 class="department-name fw-bold" style="color: #6C3428;">IT Support</h5>
                                <div class="contact-method">
                                    <i class="fas fa-envelope"></i>
                                    <span style="color: #6C3428;">itsupport@university.edu</span>
                                </div>
                                <div class="contact-method">
                                    <i class="fas fa-phone"></i>
                                    <span style="color: #6C3428;">09 421189743</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- Department Contacts End -->

        <!-- Social Media Start-->
        <section class="mb-5">
            <div class="container">
            <h2 style="color: #6C3428;">Connect With Us</h2>

            <div class="card">
                <div class="card-body text-center py-4">
                    <h4 class="card-title mb-4" style="color: #6C3428;">Follow us for updates and campus life stories!</h4>

                    <div class="d-flex justify-content-center flex-wrap">
                        <a href="#" class="social-icon mb-3">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon mb-3">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon mb-3">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-icon mb-3">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon mb-3">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>

                    <p class="mt-3 mb-0" style="color: #6C3428;">Join our community of students, alumni, and friends.</p>
                </div>
            </div>
           </div>
        </section>
        <!-- Social Media End -->

@include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
