@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Details</h3>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary float-right">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Photo" class="img-fluid">
                            @else
                                <p>No photo available</p>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $student->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $student->student_name }}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td class="bg-warning">{{ $student->username }}</td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td class="bg-warning">{{ $student->password ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d/m/Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Father Name</th>
                                    <td>{{ $student->father_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $student->phone_number ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $student->email_address ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $student->address ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($student->status == 'active')
                                            <span class="badge badge-active">Active</span>
                                        @else
                                            <span class="badge badge-inactive">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
