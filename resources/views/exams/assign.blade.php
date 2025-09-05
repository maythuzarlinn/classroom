@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>
                        <span> Grade-{{ $grade_id }}</span>Exam Result management
                    </h3>
                    <h5 class="row">
                        <div class="col">
                            <small> Subject - <span class="text-success">{{ $exam->subject }}</span></small>
                        </div>
                        <div class="col">
                            <small>
                                Date - <span class="text-success">{{ $exam->date }}</span>
                                | Month - <span
                                    class="text-primary">{{ \Carbon\Carbon::parse($exam->date)->format('F') }}</span>
                            </small>
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
                            <th class="col-lg-4">Mark</th>
                            <th width="280px">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students_by_grade as $student_by_grade)
                            <tr>
                                <td>{{ $student_by_grade->id }}</td>
                                <td>{{ $student_by_grade->full_name }}</td>
                                <td>
                                    <div class="mb-4 align-items-center">
                                        <input type="text" name="mark[{{ $student_by_grade->id }}]"
                                            value="{{ old('mark.' . $student_by_grade->id, $results[$student_by_grade->id]->mark ?? '') }}"
                                            class="" placeholder="">
                                        @error('mark')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-sm-9 items-center space-x-4 mt-1">
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="status[{{ $student_by_grade->id }}]"
                                                    value="pass" @if (isset($results[$student_by_grade->id]) && $results[$student_by_grade->id]->status === 'pass') checked @endif>
                                                <span class="ml-2">Pass</span>
                                            </label>

                                            <label class="inline-flex items-center">
                                                <input type="radio" name="status[{{ $student_by_grade->id }}]"
                                                    value="fail" @if (isset($results[$student_by_grade->id]) && $results[$student_by_grade->id]->status === 'fail') checked @endif>
                                                <span class="ml-2">Fail</span>
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
                        formaction="{{ route('exam.assign', ['id' => $grade_id, 'exam_id' => $exam_id]) }}">
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
