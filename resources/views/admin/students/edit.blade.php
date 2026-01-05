@extends('admin.layout')

@section('title', 'Edit Student')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
    <li class="breadcrumb-item active">Edit Student</li>
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
            <i class="fas fa-user-edit"></i> Edit Student
        </h3>
        <div class="section-actions">
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Students
            </a>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card edu-card">
        <div class="card-header bg-light d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Student Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- LEFT SIDE : Student Info -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="student_name" class="form-label">Student Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control @error('student_name') is-invalid @enderror"
                                           id="student_name" name="student_name" value="{{ old('student_name', $student->student_name) }}" required
                                           placeholder="Enter student name">
                                </div>
                                @error('student_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Full name of the student</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                           id="dob" name="dob" value="{{ old('dob', $student->dob) }}">
                                </div>
                                @error('dob')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Select date of birth</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="father_name" class="form-label">Father's Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-male"></i></span>
                                    <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                           id="father_name" name="father_name" value="{{ old('father_name', $student->father_name) }}"
                                           placeholder="Enter father's name">
                                </div>
                                @error('father_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Father's full name</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                           id="phone_number" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}"
                                           placeholder="Enter phone number">
                                </div>
                                @error('phone_number')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Contact phone number</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email_address" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control @error('email_address') is-invalid @enderror"
                                           id="email_address" name="email_address" value="{{ old('email_address', $student->email_address) }}"
                                           placeholder="Enter email address">
                                </div>
                                @error('email_address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Student's email address</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    <select class="form-select @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Select student status</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                              id="address" name="address" rows="3"
                                              placeholder="Enter address">{{ old('address', $student->address) }}</textarea>
                                </div>
                                @error('address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="text-muted">Full address of the student</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE : Photo + Account Info -->
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Photo Preview -->
                                <div class="text-center mb-3">
                                    <label class="form-label">Photo</label>
                                    <div class="mb-2">
                                        <img id="photoPreview"
                                             src="{{ $student->photo ? asset('storage/' . $student->photo) : 'https://via.placeholder.com/150' }}"
                                             class="img-thumbnail"
                                             style="width:150px;height:150px;object-fit:cover;cursor:pointer;border-radius:50%;"
                                             onclick="document.getElementById('photoInput').click()">
                                    </div>
                                    <input type="file" id="photoInput" class="form-control d-none"
                                           name="photo" accept="image/*"
                                           onchange="previewPhoto(event)">
                                    <small class="text-muted d-block">Click image to upload</small>
                                    @error('photo')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <!-- Account Info -->
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                        <input type="text" class="form-control"
                                               value="{{ $student->username }}" disabled>
                                    </div>
                                    <small class="text-muted">Username cannot be changed</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        <input type="text" class="form-control"
                                               value="********" disabled>
                                    </div>
                                    <small class="text-muted">Password cannot be changed here</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Update Student
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
    }
}

function generatePassword() {
    const passwordField = document.getElementById('password');
    const randomNum = Math.floor(Math.random() * 90000) + 10000; // 5-digit number
    passwordField.value = 'pp' + randomNum;
}
</script>

