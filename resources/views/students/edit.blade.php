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
                        <h5 class="mb-0">Student Edit</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('students.update', $student->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div class="row mb-4 align-items-center">
                                <label for="full_name" class="col-sm-3 col-form-label text-end">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" id="full_name"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        value="{{ $student->full_name }}" placeholder="Eg. Aung Aung">
                                    @error('full_name')
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
                                                {{ old('grade_id', $student->grade_id) == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Date of birth -->
                            <div class="row mb-4 align-items-center">
                                <label class="col-sm-3 col-form-label text-end">Date of birth</label>
                                <div class="col-sm-9">
                                    <input id="date_of_birth" type="date" name="date_of_birth"
                                        value="{{ old('date_of_birth', $student->date_of_birth) }}" class="form-control">
                                    @error('date_of_birth')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Parent name -->
                            <div class="row mb-4 align-items-center">
                                <label for="parent_name" class="col-sm-3 col-form-label text-end">Parent Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="parent_name" id="parent_name"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        value="{{ $student->parent_name }}">
                                    @error('parent_name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="row mb-4 align-items-center">
                                <label for="contact" class="col-sm-3 col-form-label text-end">Contact</label>
                                <div class="col-sm-9">
                                    <input type="text" name="contact" id="contact"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        value="{{ $student->contact }}">
                                    @error('contact')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="row mb-4 align-items-center">
                                <label class="col-sm-3 col-form-label text-end">Status</label>
                                <div class="col-sm-9 items-center space-x-4 mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="active"
                                            {{ old('status', $student->status) == 'active' ? 'checked' : '' }}>
                                        <span class="ml-2">Active</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="status" value="inactive"
                                            {{ old('status', $student->status) == 'inactive' ? 'checked' : '' }}>
                                        <span class="ml-2">Inactive</span>
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
