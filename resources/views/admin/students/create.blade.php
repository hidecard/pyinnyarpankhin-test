
@extends('admin.layout')

@section('title', 'Add New Student')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
    <li class="breadcrumb-item active">Add New Student</li>
@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        Please fix the errors below.
    </div>
@endif

<div class="data-section">
    <!-- Header Actions -->
    <div class="section-header">
        <h3 class="section-title">
            <i class="fas fa-user-graduate"></i> Add New Student
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Create Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-pen me-2"></i>Student Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- LEFT SIDE : Student Info -->
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="student_name" class="form-label">Student Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control @error('student_name') is-invalid @enderror"
                                           id="student_name" name="student_name" value="{{ old('student_name') }}" required>
                                </div>
                                @error('student_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Username will be auto-generated</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                           name="dob" value="{{ old('dob') }}">
                                </div>
                                @error('dob')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="father_name" class="form-label">Father Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-male"></i></span>
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                           name="father_name" value="{{ old('father_name') }}">
                                </div>
                                @error('father_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                           name="phone_number" value="{{ old('phone_number') }}">
                                </div>
                                @error('phone_number')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email_address" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control @error('email_address') is-invalid @enderror"
                                           name="email_address" value="{{ old('email_address') }}">
                                </div>
                                @error('email_address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select class="form-select @error('status') is-invalid @enderror"
                                            name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="active" {{ old('status')=='active'?'selected':'' }}>Active</option>
                                        <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                              rows="3" name="address">{{ old('address') }}</textarea>
                                </div>
                                @error('address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE : Photo + Account -->
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-camera me-2"></i>Photo & Account</h6>
                            </div>
                            <div class="card-body text-center">
                                <!-- Photo Preview -->
                                <div class="form-group text-center mb-3">
                                    <label class="form-label">Photo</label>

                                    <div class="mb-2">
                                        <img id="photoPreview"
                                             src="https://img.icons8.com/dotty/80/gender-neutral-user.png"
                                             class="img-thumbnail"
                                             style="width:150px;height:150px;object-fit:cover;cursor:pointer;border-radius: 50%;"
                                             onclick="document.getElementById('photoInput').click()">
                                    </div>

                                    <input type="file" id="photoInput" class="form-control d-none"
                                           name="photo" accept="image/*"
                                           onchange="previewPhoto(event)">
                                    <small class="text-muted d-block">Click image to upload</small>
                                    @error('photo') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        <input type="text" class="form-control" id="username"
                                               name="username" value="{{ old('username') }}" readonly>
                                    </div>
                                    <small class="text-muted">Auto-generated</small>
                                    @error('username') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                               id="password" name="password" required>
                                        <button type="button" class="btn btn-outline-secondary"
                                                onclick="generatePassword()">
                                            <i class="fas fa-sync"></i> Generate
                                        </button>
                                    </div>
                                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Create Student
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('photoPreview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = "https://via.placeholder.com/150";
    }
}

function generateUsername() {
    const nameField = document.getElementById('student_name');
    const usernameField = document.getElementById('username');

    if (nameField.value.trim()) {
        const nameParts = nameField.value.trim().split(' ');
        const firstThree = nameParts[0].toLowerCase().substring(0, 3);
        const randomNum = Math.floor(Math.random() * 90) + 10; // 2-digit number
        usernameField.value = firstThree + 'pp' + randomNum;
    }
}

function generatePassword() {
    const passwordField = document.getElementById('password');
    const randomNum = Math.floor(Math.random() * 90000) + 10000; // 5-digit number
    passwordField.value = 'pp' + randomNum;
}

// Auto-generate username when name field changes
document.getElementById('student_name').addEventListener('input', generateUsername);

// Generate password on page load if empty
window.addEventListener('load', function() {
    if (!document.getElementById('password').value) {
        generatePassword();
    }
    if (document.getElementById('student_name').value) {
        generateUsername();
    }
});
</script>

