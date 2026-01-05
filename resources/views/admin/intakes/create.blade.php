@extends('admin.layout')

@section('title', 'Create Intake')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Create New Intake</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.intakes.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Intake Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.intakes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Intakes
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Intake
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
