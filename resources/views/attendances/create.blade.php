@extends('home')

@section('content')
<div class="container py-4 mt-4">
    <div class="row mb-2 mt-3">
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif

    <!-- Card Wrapper -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Attendance Registration</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('attendances.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Attendance Name -->
                    <!-- Classroom -->
                    <div class="mb-3">
                        <label for="classroom_id" class="form-label">Classroom</label>
                        <select name="classroom_id" id="classroom_id" class="form-select" required>
                            <option value="">-- Select Classroom --</option>
                            {{-- @foreach ($classrooms as $classroom) --}}
                                <option value="{{ }}">{{ A-001 }}</option>
                            {{-- @endforeach --}}
                        </select>
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
