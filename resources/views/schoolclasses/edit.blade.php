@extends('home')

@section('content')
    <div class="container py-4 mt-4">
        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <!-- Card Wrapper -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm mt-3">
                    <div class="card-header custom-navbar text-white">
                        <h5 class="mb-0">Class Schedule Edit</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('schoolclasses.update', $schoolclass->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Grade -->
                            <div class="row mb-4 align-items-center">
                                <label for="grade_id" class="col-sm-3 col-form-label text-end">Grade</label>
                                <div class="col-sm-9">
                                    <select name="grade_id" id="grade_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" disabled>
                                        <option value=""> Select grade </option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}"
                                                {{ old('grade_id', $schoolclass->classroom->grade_id) == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Day of Week -->
                            <div class="row mb-4 align-items-center">
                                <label for="day_of_week" class="col-sm-3 col-form-label text-end">Day of Week</label>
                                <div class="col-sm-9">
                                    <select name="day_of_week" id="day_of_week"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">Select Day</option>
                                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                            <option value="{{ $day }}"
                                                {{ old('day_of_week', $schoolclass->day_of_week) == $day ? 'selected' : '' }}>
                                                {{ $day }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('day_of_week')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Start Time -->
                            <div class="row mb-4 align-items-center">
                                <label for="start_time" class="col-sm-3 col-form-label text-end">Start Time</label>
                                <div class="col-sm-9">
                                    <input type="time" name="start_time" id="start_time"
                                        value="{{ $schoolclass->start_time }}" placeholder="Eg. 01:00 PM"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('start_time')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- End Time -->
                            <div class="row mb-4 align-items-center">
                                <label for="end_time" class="col-sm-3 col-form-label text-end">End Time</label>
                                <div class="col-sm-9">
                                    <input type="time" name="end_time" id="end_time" placeholder="Eg. 01:00 PM"
                                        value="{{ $schoolclass->end_time }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @error('end_time')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Subject -->
                            <div class="row mb-4 align-items-center">
                                <label for="subject_id" class="col-sm-3 col-form-label text-end">Subject</label>
                                <div class="col-sm-9">
                                    <select name="subject_id" id="subject_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value=""> Select subject </option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ old('subject_id', $schoolclass->subject_id) == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Classroom -->
                            <div class="row mb-4 align-items-center">
                                <label for="classroom_id" class="col-sm-3 col-form-label text-end">Classroom</label>
                                <div class="col-sm-9">
                                    <select name="classroom_id" id="classroom_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value=""> Select classroom </option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}"
                                                {{ old('classroom_id', $classroom->grade_id) == $schoolclass->classroom_id ? 'selected' : '' }}>
                                                {{ $classroom->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('classroom_id')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Teacher -->
                            <div class="row mb-4 align-items-center">
                                <label for="teacher_id" class="col-sm-3 col-form-label text-end">Teacher</label>
                                <div class="col-sm-9">
                                    <select name="teacher_id" id="teacher_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value=""> Select teacher </option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ old('teacher_id', $schoolclass->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Save Button -->
                            <div class="text-center">
                                <button type="reset" class="btn btn-danger ml-3">Reset</button>
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                </div>
                <div>
                @endsection
