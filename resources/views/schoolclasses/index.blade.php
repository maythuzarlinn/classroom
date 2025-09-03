@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Class Timetable (Schedule)</h3>
                </div>
                <div class="d-flex mb-2">
                    <a class="btn custom-create-btn" href="{{ route('schoolclasses.create') }}">
                        <i class="fa-solid fa-plus text-light"></i>
                        <span class="d-none d-lg-inline text-light"> Add Class </span>
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
                    <th>Room</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Teacher</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>Grade - {{ $class->grade }}</td>
                        <td>{{ $class->subject }}</td>
                        <td>{{ $class->classroom }}</td>
                        <td>{{ $class->day_of_week }}</td>
                        <td> {{ date('h:i A', strtotime($class->start_time)) }} -
                            {{ date('h:i A', strtotime($class->end_time)) }}</td>
                        <td>{{ $class->teacher }}</td>
                        <td>
                            <form action="{{ route('schoolclasses.destroy', $class->id) }}" method="Put">
                                <a class="btn btn-primary" href="{{ route('schoolclasses.edit', $class->id) }}">Edit</a>
                                <button type="submit" formaction="{{ route('schoolclass.delete', $class->id) }}" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {!! $classes->links() !!}
        </div>
    </div>
@endsection
