@extends('home')

@section('content')
    <div class="container py-3 mt-2">
        <div class="row py-3 mt-4">
            <!-- Dashboard Data -->
            <div class="row flex-colum flex-lg-row p-4">
                <div class="col-md-3 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title h2">81</h3>
                            <span class="text-success">
                                <i class="fa-solid fa-chart-line"></i>
                                Total Students
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title h2">8</h3>
                            <span class="text-success">
                                <i class="fa-solid fa-chart-line"></i>
                                Active Classes Today
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title h2">5</h3>
                            <span class="text-success">
                                <i class="fa-solid fa-chart-line"></i>
                                Assignments Due
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title h2">95%</h3>
                            <span class="text-success">
                                <i class="fa-solid fa-chart-line"></i>
                                Attendance rate
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
