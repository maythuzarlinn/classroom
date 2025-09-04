@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Exam Schedule</h3>
                </div>
                <div class="d-flex">
                    <a class="btn custom-create-btn" href="{{ route('exams.create') }}">
                        <i class="fa-solid fa-plus text-light"></i>
                        <span class="d-none d-lg-inline text-light"> Add exams </span>
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
                    <th>Room</th>
                    <th>Grade</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th class="text-center" width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr>
                        <td>{{ $exam->room }}</td>
                        <td>{{ $exam->grade }}</td>
                        <td>{{ $exam->subject }}</td>
                        <td>{{ $exam->date }}</td>
                        <td>{{ date('h:i A', strtotime($exam->start_time)) }} -
                            {{ date('h:i A', strtotime($exam->end_time)) }}</td>
                        <td>{{ $exam->description }}</td>
                        <td>
                            <form action="{{ route('exams.destroy', $exam->id) }}" method="PUT">
                                <a class="btn btn-secondary" style="width:70px; font-size:8px;" href="{{ route('exam.assign', ['id' => $exam->grade_id, 'exam_id' => $exam->id]) }}">Assign/<br>ViewStudent</a>
                                <a class="btn btn-primary" href="{{ route('exams.edit', $exam->id) }}">Edit</a>
                                <button type="submit" formaction="{{ route('exam.delete', $exam->id) }}"
                                    class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {!! $exams->links() !!}
        </div>
    </div>
@endsection
