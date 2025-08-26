@extends('home')

@section('content')
    <div class="container py-4 mt-4">
        <div class="row mt-2">
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        <!-- Card Wrapper -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Classroom Registration</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('schoolclasses.store') }}" method="POST">
                    @csrf

                    <!-- Classroom -->
                    <div class="mb-3">
                        <label for="classroom_id" class="form-label">Classroom</label>
                        <select name="classroom_id" id="classroom_id" class="form-select" required>
                            <option value="">-- Select Classroom --</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Day of Week -->
                    <div class="mb-3">
                        <label for="day_of_week" class="form-label">Day of Week</label>
                        <select name="day_of_week" id="day_of_week" class="form-select" required>
                            <option value="">-- Select Day --</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>

                    <!-- Start Time -->
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" required>
                    </div>

                    <!-- End Time -->
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" required>
                    </div>

                    <!-- Subject -->
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-select" required>
                            <option value="">-- Select Subject --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Teacher -->
                    <div class="mb-3">
                        <label for="teacher_id" class="form-label">Teacher</label>
                        <select name="teacher_id" id="teacher_id" class="form-select" required>
                            <option value="">-- Select Teacher --</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Create Class</button>
                </form>

            </div>
        </div>
    </div>
@endsection
