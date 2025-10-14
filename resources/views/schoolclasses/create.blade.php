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
                        <h5 class="mb-0">Class Registration</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('schoolclasses.store') }}" method="POST">
                            @csrf
                            <!-- Grade -->
                            <div class="row mb-4 align-items-center">
                                <label for="grade_id" class="col-sm-3 col-form-label text-end">Grade</label>
                                <div class="col-sm-9">
                                    <select name="grade_id" id="grade_id" class="form-select">
                                        <option value="">Select Grade</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
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
                                        <option value="">Select Classroom</option>
                                        @foreach ($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('classroom_id')
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
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>
                                    @error('day_of_week')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dynamic Subjects Section -->
                            <div class="mb-4">
                                <label class="col-form-label fw-bold mb-2">Subjects & Schedule</label>
                                <div id="subjects-container">
                                    <div class="text-muted text-center py-2 border rounded">
                                        Select a grade to load subjects.
                                    </div>
                                </div>
                            </div>

                            <!-- Teacher -->
                            <div class="row mb-4 align-items-center">
                                <label for="teacher_id" class="col-sm-3 col-form-label text-end">Teacher</label>
                                <div class="col-sm-9">
                                    <select name="teacher_id" id="teacher_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">Select Teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
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
    flatpickr("#datepicker", { dateFormat: "Y-m-d" });

    // 🧠 When grade changes → load subjects dynamically
    document.getElementById('grade_id').addEventListener('change', function() {
        const gradeId = this.value;
        const container = document.getElementById('subjects-container');
        container.innerHTML = '<div class="text-center text-secondary py-3">Loading subjects...</div>';

        if (gradeId) {
            fetch(`/grades/${gradeId}/subjects-view`)
                .then(res => res.text())
                .then(html => {
                    container.innerHTML = html;
                })
                .catch(() => {
                    container.innerHTML = '<div class="alert alert-danger">Error loading subjects.</div>';
                });
        } else {
            container.innerHTML = '<div class="text-muted text-center py-2 border rounded">Select a grade to load subjects.</div>';
        }
    });
</script>
@endsection
