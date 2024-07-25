@extends('Backend.Layout.app')

@section('content')
    

<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Total visitor</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{$totalVisitor}}</h2>
                        </div>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-chart-pie text-info icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Total services</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{$totalServices}}</h2>
                        </div>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-chart-pie text-info icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Total projects</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{$totalProjects}}</h2>
                        </div>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-chart-pie text-info icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Total Courses</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{$totalCourses}}</h2>
                            
                        </div>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-chart-pie text-info icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Total Contacts</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{$totalContacts}}</h2>
                           
                        </div>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-chart-pie text-info icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Total Review</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">{{$totalReviews}}</h2>
                        </div>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-chart-pie text-info icon-lg"></i>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
