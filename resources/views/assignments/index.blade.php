@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Assignment Information</h3>
                </div>
                <div class="d-flex">
                    <a class="btn custom-create-btn" href="{{ route('assignments.create') }}">
                        <i class="fa-solid fa-plus text-light"></i>
                        <span class="d-none d-lg-inline text-light"> Add assignments </span>
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
                    <th>Grade</th>
                    <th>Subject</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Day Left</th>
                    <th>Assign by</th>
                    <th width="280px">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->grade }}</td>
                        <td>{{ $assignment->subject }}</td>
                        <td>{{ $assignment->title }}</td>
                        <td>{{ $assignment->description }}</td>
                        <td>{{ $assignment->deadline }}</td>
                        <td>{{ $assignment->day_left }}</td>
                        <td>{{ $assignment->teacher }}</td>
                        <td>
                            <form action="{{ route('assignments.destroy', $assignment->id) }}" method="PUT">
                                <a class="btn" href="{{ route('assignment.grade', ['id' => $assignment->grade_id, 'assignment' => $assignment->id]) }}">View</a>
                                <a class="btn btn-primary" href="{{ route('assignments.edit', $assignment->id) }}">Edit</a>
                                <button type="submit" formaction="{{ route('assignment.delete', $assignment->id) }}"
                                    class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {!! $assignments->links() !!}
        </div>
    </div>
@endsection
