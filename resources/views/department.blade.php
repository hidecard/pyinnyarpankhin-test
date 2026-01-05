<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Department page</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

@include('nav')

<!-- Hero Section -->
<section class="hero-section-department">
  <div class="container">
    <div class="intro-text2">
      <h2 style="color: #FF7300;">Departments</h2>
      <p class="lead-2" style="font-size: x-large">
        Explore our diverse academic departments, each dedicated to excellence in teaching, research, and community service.
      </p>
    </div>
    <a href="#pro"><button class="butn">Explore Programs</button></a>
  </div>
</section>

<!-- Faculties & Schools -->
<div class="container mt-5">
  <h2 style="color: #FF7300;">Our Faculties & Schools</h2>
  <p style="color: #6c3428;">Discover our comprehensive range of academic disciplines across five major faculties.</p>
</div>

<!-- Departments Cards -->
<div class="container my-4 d-flex justify-content-center align-items-center text-center">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse($departments as $department)
      <div class="col-lg-6">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title" style="color: #FF7300;">
              <i class="fas fa-university me-2"></i>{{ $department->department_name }}
            </h5>
            <p class="card-text">{{ $department->description ?: 'Explore our programs and research opportunities.' }}</p>
            <button class="ex-btn">Explore Programs</button>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <p class="text-center text-muted">No departments available at this time.</p>
      </div>
    @endforelse
  </div>
</div>

<!-- Highlight Box -->
<div class="highlight-box">
  <h3><i class="fas fa-flask"></i> World-Class Research Facilities</h3>
  <p>
    Our students have access to advanced laboratories and research equipment, including a newly established nanotechnology center, molecular biology lab, and high-performance computing cluster for data science research.
  </p>
</div>

<!-- Programs Offered -->
<div class="container mt-5" id="pro">
  <h2 class="text-center" style="color: #FF7300;">Programs Offered</h2>
  <div class="container my-5 border p-4 shadow-sm bg-white">
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-dark custom-header">
          <tr>
            <th scope="col">Program Name</th>
            <th scope="col">Level</th>
            <th scope="col">Duration</th>
            <th scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
          @forelse($degrees as $degree)
            <tr>
              <td class="fw-bold" style="color: #6C3428;">{{ $degree->degree_name }}</td>
              <td class="fw-bold" style="color: #6C3428;">{{ ucfirst($degree->level) }}</td>
              <td class="fw-bold" style="color: #6C3428;">{{ $degree->duration->length ?? 'N/A' }} Years</td>
              <td class="fw-bold text-orange">
                <a href="#majors" class="text-decoration-none">View Details</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center">No degrees available</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Industry Partnerships Highlight -->
<div class="highlight-box">
  <h3><i class="fas fa-handshake"></i> Industry Partnerships</h3>
  <p>
    We maintain strong collaborations with leading industries and research institutions, providing students with internship opportunities and real-world research projects.
  </p>
</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
