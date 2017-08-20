@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <h1 class="dashboard-header-item">Dashboard</h1>
            <!-- <div id="system_status" class="dashboard-header-item page" data-page="dashboard"></div> -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Estimates</strong></div>
                    <div class="panel-body dashboard-job-panel">
                        <ul>
                            <li class="warning">Open<span>{{$openEstimates}}</span></li>
                            <li class="success">Completed<span>{{$completedEstimates}}</span></li>
                            <li class="default">Total<span>{{$totalEstimates}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-6 first -->

        <div class="col-lg-6">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Jobs</strong></div>
                    <div class="panel-body dashboard-job-panel">
                        <ul>
                            <li class="warning">Open<span>{{$openJobs}}</span></li>
                            <li class="info">Done<span>{{$doneJobs}}</span></li>
                            <li class="success">Completed<span>{{$completeJobs}}</span></li>
                            <li class="default">Total<span>{{$totalJobs}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-6 last -->
    </div>


@endsection