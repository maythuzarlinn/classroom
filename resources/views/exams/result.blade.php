@extends('home')

@section('content')
    <div class="container py-4 mt-4">
        <h3 class="mt-3">Exam Result</h3>

        <form method="GET" action="{{ route('exam.result') }}">
            <div class="row">
                <div class="col-md-4">
                    <select name="grade_id" id="grade_id" class="form-control" required>
                        <option value="">Select Grade</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                                {{ $grade->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <input type="month" name="year_month" id="year_month" value="{{ request('year_month') }}"
                        class="form-control" placeholder="Select Month" required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th width="50px">Roll No</th>
                    <th>Student Name</th>
                    <th>Myanmar</th>
                    <th>English</th>
                    <th>Mathematics</th>
                    <th>Science</th>
                    <th>Social Studies</th>
                    <th>Grand Total</th>
                    <th>Percent (%)</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $studentId => $subjects)
                    @php
                        $student = $subjects->first();
                        $total = $subjects->sum('mark');
                        $maxMarks = count($subjects) * 100; // adjust if subject max differs
                        $percent = $maxMarks ? round(($total / $maxMarks) * 100, 2) : 0;
                        // Check if any subject mark < 41
                        $hasFailedSubject = $subjects->contains(function ($subject) {
                            return $subject->mark < 40;
                        });
                        $result = $hasFailedSubject ? 'Fail' : 'Pass';
                    @endphp
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td
                            class="{{ optional($subjects->firstWhere('subject_name', 'Myanmar'))->mark < 40 ? 'text-danger' : '' }}">
                            {{ optional($subjects->firstWhere('subject_name', 'Myanmar'))->mark }}
                        </td>
                        <td
                            class="{{ optional($subjects->firstWhere('subject_name', 'English'))->mark < 40 ? 'text-danger' : '' }}">
                            {{ optional($subjects->firstWhere('subject_name', 'English'))->mark }}
                        </td>
                        <td
                            class="{{ optional($subjects->firstWhere('subject_name', 'Maths'))->mark < 40 ? 'text-danger' : '' }}">
                            {{ optional($subjects->firstWhere('subject_name', 'Maths'))->mark }}
                        </td>
                        <td
                            class="{{ optional($subjects->firstWhere('subject_name', 'Science'))->mark < 40 ? 'text-danger' : '' }}">
                            {{ optional($subjects->firstWhere('subject_name', 'Science'))->mark }}
                        </td>
                        <td
                            class="{{ optional($subjects->firstWhere('subject_name', 'Social Studies'))->mark < 40 ? 'text-danger' : '' }}">
                            {{ optional($subjects->firstWhere('subject_name', 'Social Studies'))->mark }}
                        </td>
                        <td>{{ $total }}/{{ $maxMarks }}</td>
                        <td>{{ $percent }}%</td>
                        <td>
                            <span class="badge {{ $result == 'Pass' ? 'bg-success' : 'bg-danger' }}">
                                {{ $result }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
