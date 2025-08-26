@extends('home')

@section('content')
<div class="container py-4 mt-4">
    <div class="row mb-2 mt-3">
        <div class="col-lg-12 d-flex align-items-center">
            <a class="btn me-2" href="{{ route('grades.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif

    <!-- Card Wrapper -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Grade Registration</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('grades.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Grade Name -->
                <div class="row mb-3 align-items-center">
                    <label for="title" class="col-sm-3 col-form-label">Grade Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="Eg. Grade-1">
                        @error('title')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
