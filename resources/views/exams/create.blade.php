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
                    <h5 class="mb-0">Exam Creation</h5>
                </div>
                <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                    <form action="{{ route('exams.store') }}" method="POST">
                        @csrf
                        <!-- >Exam Title -->
                        <div class="row mb-4 align-items-center">
                            <label for="exam_title" class="col-sm-3 col-form-label text-end">Exam Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="exam_title" id="exam_title"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    value="{{ old('exam_title') }}" placeholder="Eg. G1_exam_001">
                                @error('exam_title')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Date-->
                        <div class="row mb-4 align-items-center">
                            <label class="col-sm-3 col-form-label text-end">Date</label>
                            <div class="col-sm-9">
                                <input id="datepicker" type="date" name="date" value=""
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="yyyy-mm-dd">
                                @error('date')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Classroom Name -->
                        <div class="row mb-4 align-items-center">
                            <label for="classroom_id" class="col-sm-3 col-form-label text-end">Room</label>
                            <div class="col-sm-9">
                                <select name="classroom_id" id="classroom_id"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Select Room</option>
                                    @foreach ($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                                @error('classroom_id')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Grade -->
                        <div class="row mb-4 align-items-center">
                            <label for="grade_id" class="col-sm-3 col-form-label text-end">Grade</label>
                            <div class="col-sm-9">
                                <select name="grade_id" id="grade_id"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Select Grade</option>
                                    @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ old('grade_id')==$grade->id ? 'selected' : ''
                                        }}>
                                        {{ $grade->title }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-4 align-items-center">
                            <label for="description" class="col-sm-3 col-form-label text-end">Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="description" id="description"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    value="{{ old('description') }}" placeholder="Eg. July Monthly Exam">
                                @error('description')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Subjects with Start/End Time -->
                        <div class="mb-4">
                            <label class="col-form-label fw-bold mb-2">Subjects & Schedule</label>
                            @foreach ($subjects as $subject)
                            <div class="card mb-3 border border-secondary-subtle shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 text-primary">{{ $subject->title }}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Hidden subject_id -->
                                    <input type="hidden" name="subjects[{{ $subject->id }}][subject_id]"
                                        value="{{ $subject->id }}">

                                    <!-- Start Time -->
                                    <div class="row mb-3 align-items-center">
                                        <label for="start_time_{{ $subject->id }}"
                                            class="col-sm-3 col-form-label text-end">Start Time</label>
                                        <div class="col-sm-9">
                                            <input type="time" name="subjects[{{ $subject->id }}][start_time]"
                                                id="start_time_{{ $subject->id }}"
                                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Eg. 01:00 PM"
                                                value="{{ old('subjects.' . $subject->id . '.start_time') }}">
                                            @error('subjects.' . $subject->id . '.start_time')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- End Time -->
                                    <div class="row mb-3 align-items-center">
                                        <label for="end_time_{{ $subject->id }}"
                                            class="col-sm-3 col-form-label text-end">End Time</label>
                                        <div class="col-sm-9">
                                            <input type="time" name="subjects[{{ $subject->id }}][end_time]"
                                                id="end_time_{{ $subject->id }}"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Eg. 03:00 PM"
                                                value="{{ old('subjects.' . $subject->id . '.end_time') }}">
                                            @error('subjects.' . $subject->id . '.end_time')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Save Button -->
                        <div class="text-center">
                            <button type="reset" class="btn btn-danger ml-3">Reset</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#datepicker", {
            dateFormat: "Y-m-d", // format for saving in DB
        });
</script>
@endsection