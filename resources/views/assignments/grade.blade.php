@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>
                        Assignment Status of <span> Grade-{{ $grade_id }}</span>
                    </h3>
                    <h5 class="row">
                        <div class="col">
                            <small> Title - <span class="text-success">{{ $assignment->title }}</span></small>
                        </div>
                        <div class="col">
                            <small> Description - <span class="text-success">{{ $assignment->description }}</span></small>
                        </div>
                        <div class="col">
                            <small> Dead Line - <span class="text-success">{{ $assignment->deadline }}</span></small>
                        </div>
                        <div class="col">
                            <small> Subject - <span class="text-success">{{ $assignment->subject }}</span></small>
                        </div>
                        <div class="col">
                            <small> Assigned By - <span class="text-success">{{ $assignment->teacher }}</span></small>
                        </div>
                    </h5>
                </div>
            </div>
        </div>
        <form method="POST">
            @csrf
            <!-- Hidden Grade ID -->
            <input type="hidden" name="grade" value="{{ $grade_id }}">
            <div style="overflow-y: auto; overflow-x: hidden; max-height: 500px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-lg-1">Roll.no</th>
                            <th class="col-lg-4">Student Name</th>
                            <th width="280px">Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students_by_grade as $student_by_grade)
                            <tr>
                                <td>{{ $student_by_grade->id }}</td>
                                <td>{{ $student_by_grade->full_name }}</td>
                                <td>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-sm-9 items-center space-x-4 mt-1">
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="status[{{ $student_by_grade->id }}]"
                                                    value="submitted"
                                                    class="text-blue-600 border-gray-300 focus:ring-blue-500"
                                                    @if (isset($status[$student_by_grade->id]) && $status[$student_by_grade->id] === 'submitted') checked @endif>
                                                <span class="ml-2">Submitted</span>
                                            </label>

                                            <label class="inline-flex items-center">
                                                <input type="radio" name="status[{{ $student_by_grade->id }}]"
                                                    value="unsubmitted"
                                                    class="text-blue-600 border-gray-300 focus:ring-blue-500"
                                                    @if (isset($status[$student_by_grade->id]) && $status[$student_by_grade->id] === 'unsubmitted') checked @endif>
                                                <span class="ml-2">Unsubmitted</span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            {{-- Save Button --}}
            <div class="row align-items-center mt-3">
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-success w-100"
                        formaction="{{ route('assignment.grade', ['id' => $grade_id, 'assignment_id' => $assignment_id]) }}">
                        Save
                    </button>
                </div>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("tr").forEach(function(row) {
                let checkboxes = row.querySelectorAll(".attendance-checkbox");
                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener("change", function() {
                        if (this.checked) {
                            checkboxes.forEach(cb => {
                                if (cb !== this) cb.disabled = true;
                            });
                        } else {
                            checkboxes.forEach(cb => cb.disabled = false);
                        }
                    });
                });
            });
        });
    </script>
@endsection
