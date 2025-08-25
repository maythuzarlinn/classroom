@extends('home')

@section('content')
    <div class="container py-4 mt-4">
        <div class="row mb-2 mt-3">
            <div class="col-lg-12 d-flex align-items-center">
                <a class="btn me-2" href="{{ route('students.index') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h3 class="mb-0">Edit student information</h3>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Student Name:</strong>
                        <input type="text" name="full_name" value="{{ $student->full_name }}" class="form-control" placeholder="Student Name">
                        @error('full_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date of birth:</strong>
                        <input id="date_of_birth" type="date" name="date_of_birth"
                            value="{{ $student->date_of_birth }}" onfocus="(this.type='date')"
                            onblur="(this.type='text')" class="form-control" placeholder="">
                        @error('date_of_birth')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Parent Name:</strong>
                        <input type="text" name="parent_name" value="{{ $student->parent_name }}" class="form-control" placeholder="Parent Name">
                        @error('parent_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Contact:</strong>
                        <input type="text" name="contact" value="{{ $student->contact }}" class="form-control" placeholder="Contact">
                        @error('contact')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <button type="reset" class="btn btn-danger ml-3">Reset</button>
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection      