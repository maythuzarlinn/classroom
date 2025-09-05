@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h5>Exam Result</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row mx-auto pull-right">
                    <form action="{{ route('exam.result') }}" method="GET" role="search">
                        <div class="input-group justify-content-end">
                            <!-- Grade Search -->
                            <label for="grade" class="text-end pt-2 me-4">{{ __('Grade: ') }}</label>
                            <div class="me-4">
                                <input name="grade" id="grade" type="text" class="form-control"
                                    value="{{ request('grade') }}" placeholder="Eg. Grade-1">
                            </div>
                            <!-- Month Search -->
                            <label for="month" class="text-end pt-2 me-4">{{ __('Month: ') }}</label>
                            <div class="me-4">
                                <input name="month" id="month" type="text" class="form-control"
                                    value="{{ request('month') }}" placeholder="Eg. September">
                            </div>
                            <button type="submit" class="btn btn-success rounded col-1 p-2 me-4">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
