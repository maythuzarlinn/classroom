@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Classroom Information</h3>
                </div>
                <div class="d-flex mb-2">
                    <a class="btn custom-create-btn" href="{{ route('classrooms.create') }}">
                        <i class="fa-solid fa-plus text-light"></i>
                        <span class="d-none d-lg-inline text-light"> Add Classroom </span>
                    </a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->name }}</td>
                        <td>
                            <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('classrooms.edit', $classroom->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {!! $classrooms->links() !!}
        </div>
    </div>
@endsection
