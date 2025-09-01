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
                        <h5 class="mb-0">Exam Edit</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('exams.update', $exam->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!--Date-->
                            <div class="row mb-4 align-items-center">
                                <label class="col-sm-3 col-form-label text-end">Date</label>
                                <div class="col-sm-9">
                                    <input id="datepicker" type="date" name="date" value="{{ old('date', $exam->date) }}"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                     placeholder="yyyy-mm-dd">
                                    @error('date')
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
                                        <option value=""> Select Subject </option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ old('subject_id', $exam->subject_id) == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
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
                                                {{ old('grade_id', $exam->grade_id) == $grade->id ? 'selected' : '' }}>
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
                                        value="{{ old('description', $exam->description) }}" placeholder="Eg.Lesson-1 exercise">
                                    @error('description')
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
@section('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d", // format for saving in DB
    });
</script>
@endsection
