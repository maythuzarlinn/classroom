@extends('home')

@section('content')
<div class="container py-4 mt-4">
    @if (session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-3">
                <div class="card-header custom-navbar text-white">
                    <h5 class="mb-0">Exam Creation</h5>
                </div>
                <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                    <form action="{{ route('exams.store') }}" method="POST">
                        @csrf
                        <!-- Exam Title -->
                        <div class="row mb-4 align-items-center">
                            <label for="exam_title" class="col-sm-3 col-form-label text-end">Exam Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="exam_title" id="exam_title"
                                    class="form-control"
                                    value="{{ old('exam_title') }}" placeholder="Eg. G1_exam_001">
                                @error('exam_title')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="row mb-4 align-items-center">
                            <label class="col-sm-3 col-form-label text-end">Date</label>
                            <div class="col-sm-9">
                                <input id="datepicker" type="date" name="date"
                                    class="form-control"
                                    placeholder="yyyy-mm-dd">
                                @error('date')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Classroom -->
                        <div class="row mb-4 align-items-center">
                            <label for="classroom_id" class="col-sm-3 col-form-label text-end">Room</label>
                            <div class="col-sm-9">
                                <select name="classroom_id" id="classroom_id" class="form-select">
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

                        <!-- Description -->
                        <div class="row mb-4 align-items-center">
                            <label for="description" class="col-sm-3 col-form-label text-end">Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="description" id="description"
                                    class="form-control"
                                    value="{{ old('description') }}" placeholder="Eg. July Monthly Exam">
                                @error('description')
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
