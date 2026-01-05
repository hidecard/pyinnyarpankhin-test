@extends('admin.layout')

@section('title', 'Edit Admission')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Admission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.admissions.update', $admission) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="admissions_name" class="form-label">Admissions Name</label>
                            <input type="text" class="form-control @error('admissions_name') is-invalid @enderror"
                                   id="admissions_name" name="admissions_name" value="{{ old('admissions_name', $admission->admissions_name) }}" required>
                            @error('admissions_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $admission->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   id="phone" name="phone" value="{{ old('phone', $admission->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', $admission->department_id) == $department->id ? 'selected' : '' }}>{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="minimum_gpa" class="form-label">Minimum GPA</label>
                            <input type="number" class="form-control @error('minimum_gpa') is-invalid @enderror"
                                   id="minimum_gpa" name="minimum_gpa" value="{{ old('minimum_gpa', $admission->minimum_gpa) }}" required>
                            @error('minimum_gpa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="transcripts" class="form-label">Transcripts</label>
                            <input type="text" class="form-control @error('transcripts') is-invalid @enderror"
                                   id="transcripts" name="transcripts" value="{{ old('transcripts', $admission->transcripts) }}" required>
                            @error('transcripts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="recommendation" class="form-label">Recommendation</label>
                            <input type="number" class="form-control @error('recommendation') is-invalid @enderror"
                                   id="recommendation" name="recommendation" value="{{ old('recommendation', $admission->recommendation) }}" required>
                            @error('recommendation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="edu_degree" class="form-label">Educational Degree</label>
                            <input type="text" class="form-control @error('edu_degree') is-invalid @enderror"
                                   id="edu_degree" name="edu_degree" value="{{ old('edu_degree', $admission->edu_degree) }}" required>
                            @error('edu_degree')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sop" class="form-label">Statement of Purpose</label>
                            <input type="number" class="form-control @error('sop') is-invalid @enderror"
                                   id="sop" name="sop" value="{{ old('sop', $admission->sop) }}" required>
                            @error('sop')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.admissions.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Admission
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
