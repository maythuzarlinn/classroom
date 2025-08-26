@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Grade Information</h3>
                </div>
                <div class="d-flex mb-2">
                    <a class="btn custom-create-btn" href="{{ route('grades.create') }}">
                        <i class="fa-solid fa-plus text-light"></i>
                        <span class="d-none d-lg-inline text-light"> Add Grade </span>
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
                    <th>Title</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <td>{{ $grade->title }}</td>
                        <td>
                            <form action="{{ route('grades.destroy', $grade->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('grades.edit', $grade->id) }}">Edit</a>
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
            {!! $grades->links() !!}
        </div>
    </div>
@endsection
