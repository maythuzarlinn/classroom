@extends('home')

@section('content')
<div class="container py-3 mt-2">
    <div class="row py-3 mt-4">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Student List</h3>
            </div>
            <div class="d-flex mb-2">
                <a class="btn custom-create-btn" href="{{ route('students.create') }}">
                    <i class="fa-solid fa-plus text-light"></i>
                    <span class="d-none d-lg-inline text-light"> Add Student </span>
                </a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Parent Name</th>
                <th>Contact</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->full_name }}</td>
                <td>{{ $student->date_of_birth }}</td>
                <td>{{ $student->parent_name }}</td>
                <td>{{ $student->contact }}</td>
                <td>
                    <form action="{{ route('students.destroy', $student->id) }}" method="Put">
                        <a class="btn btn-primary" href="{{ route('students.edit', $student->id) }}">Edit</a>
                        <button type="submit" formaction="{{ route('student.delete', $student->id) }}" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Pagination --}}
            <div class="d-flex justify-content-end">
            {!! $students->links() !!}
        </div>
</div>
@endsection