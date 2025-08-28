@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Attendance Information</h3>
                </div>
                <div class="d-flex">
                    <a class="btn custom-create-btn" href="{{ route('attendances.create') }}">
                        <i class="fa-solid fa-plus text-light"></i>
                        <span class="d-none d-lg-inline text-light"> Add attendances according to grade </span>
                    </a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body mt-2">
            <div class="form-group mb-3">
                <div class="row mx-auto pull-right">
                    <form action="{{ route('attendances.index') }}" method="GET" role="search">
                        <div class="input-group justify-content-end">

                            <!-- Grade Search -->
                            <label for="grade" class="text-end pt-2 me-4">{{ __('Grade: ') }}</label>
                            <div class="me-4">
                                <input name="grade" id="grade" type="text" class="form-control"
                                    value="{{ request('grade') }}" placeholder="Eg. Grade-1">
                            </div>

                            <!-- Date Search -->
                            <label for="date" class="text-end pt-2 me-4">{{ __('Date: ') }}</label>
                            <div class="me-4">
                                <input name="date" id="date" type="text" class="form-control"
                                    value="{{ request('date') }}" placeholder="Eg. 2025-08-05">
                            </div>

                            <button type="submit" class="btn btn-success rounded col-1 p-2 me-4">
                                Search
                            </button>
                        </div>
                    </form>

                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped mt-4">
                            <thead>
                                <tr class="text-center text-light bg-info bg-opacity-75 table-hover">
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Grade</th>
                                    <th>Student</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (strpos($attendances, 'No') !== false)
                                    <tr class="text-center">
                                        <td></td>
                                        <td></td>
                                        <td>{{ 'No data available in table' }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @else
                                    @foreach ($attendances as $attendance)
                                        <tr class="text-center">
                                            <td>{{ $attendance->id }}</td>
                                            <td>{{ $attendance->date }}</td>
                                            <td>{{ $attendance->grade }}</td>
                                            <td>{{ $attendance->student }}</td>
                                            <td>{{ $attendance->status }}</td>
                                            <td>
                                                <form action="{{ route('attendances.destroy', $attendance->id) }}"
                                                    method="Put">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('attendances.edit', $attendance->id) }}">Edit</a>
                                                    <button type="submit"
                                                        formaction="{{ route('attendance.delete', $attendance->id) }}"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end">
                        @if (strpos($attendances, 'No') !== false)
                        @else
                            {!! $attendances->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
