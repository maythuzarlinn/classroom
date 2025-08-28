@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3><span> Grade-{{ $grade_id }}</span> Attendance </h3>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('attendances.store') }}">
            @csrf
            <!-- Hidden Student ID -->
            <input type="hidden" name="grade" value="{{ $grade_id }}">
            <!-- Date -->
            <div class="row mb-4 align-items-center">
                <label class="col-sm-1 col-form-label">Date </label>
                <div class="col-sm-11">
                    <input id="date" type="date" name="date" value=""
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="">
                    @error('date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
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
                                <!-- Status -->
                                <div class="row mb-4 align-items-center">
                                    <div class="col-sm-9 items-center space-x-4 mt-1">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="status[{{ $student_by_grade->id }}]" value="present"
                                                class="text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <span class="ml-2">Present</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="status[{{ $student_by_grade->id }}]" value="absent"
                                                class="text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <span class="ml-2">Absent</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="status[{{ $student_by_grade->id }}]" value="late"
                                                class="text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <span class="ml-2">Late</span>
                                        </label>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
{{-- Pagination and Save Button --}}
<div class="row align-items-center mt-3">

    <div class="col-sm-11 text-end">
        @if (strpos($students_by_grade, 'No') === false)
            {!! $students_by_grade->links() !!}
        @endif
    </div>
        <div class="col-sm-1">
        <button type="submit" class="btn btn-success w-100">
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
