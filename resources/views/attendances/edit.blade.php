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
                        <h5 class="mb-0">Attendance Edit</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Date -->
                            <div class="row mb-4 align-items-center">
                                <label class="col-sm-3 col-form-label text-end">Date of birth</label>
                                <div class="col-sm-9">
                                    <input id="date" type="date" name="date"
                                        value="{{ old('date', $attendance->date) }}" class="form-control">
                                    @error('date')
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
                                        <option value=""> Select Grade </option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}"
                                                {{ old('grade_id', $attendance->grade_id) == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Name -->
                            <div class="row mb-4 align-items-center">
                                <label for="full_name" class="col-sm-3 col-form-label text-end">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" id="full_name"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        value="{{ $attendance->student->full_name ?? ''  }}" placeholder="Eg. Aung Aung">
                                    <!-- Hidden input to submit the student_id -->
                                    <input type="hidden" name="student_id" value="{{ $attendance->student_id }}">                                        
                                    @error('full_name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="row mb-4 align-items-center">
                                <label class="col-sm-3 col-form-label text-end">Status</label>
                                <div class="col-sm-9 items-center space-x-4 mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="present"
                                            {{ old('status', $attendance->status) == 'present' ? 'checked' : '' }}>
                                        <span class="ml-2">Present</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="absent"
                                            {{ old('status', $attendance->status) == 'absent' ? 'checked' : '' }}>
                                        <span class="ml-2">Absent</span>
                                    </label>
                                   <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="late"
                                            {{ old('status', $attendance->status) == 'late' ? 'checked' : '' }}>
                                        <span class="ml-2">Late</span>
                                    </label>                                    

                                    @error('status')
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
