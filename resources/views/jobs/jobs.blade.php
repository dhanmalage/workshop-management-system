@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-2">
            <h3 class="page-header">Jobs</h3>
        </div>
        <div class="col-lg-10">
            <a href="{{url('estimates')}}" type="button" class="page-header btn btn-primary">Estimates</a>
            <a href="{{url('estimates/create')}}" type="button" class="page-header btn btn-primary">New Estimate</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a type="button" class="btn btn-primary" href="#all" aria-controls="all" role="tab" data-toggle="tab">All Jobs</a></li>
                <li role="presentation"><a type="button" class="btn btn-warning" href="#open" aria-controls="open" role="tab" data-toggle="tab">Open Jobs</a></li>
                <li role="presentation"><a type="button" class="btn btn-info" href="#job_done" aria-controls="job_done" role="tab" data-toggle="tab">Job Done</a></li>
                <li role="presentation"><a type="button" class="btn btn-success" href="#complete" aria-controls="complete" role="tab" data-toggle="tab">Completed Jobs</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="all">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Job Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                                    <thead>
                                    <tr>
                                        <th>Job #</th>
                                        <th>Customer</th>
                                        <th>Vehicle</th>
                                        <th>Promised Date</th>
                                        <th>S.Advisor</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jobs as $job)
                                        <tr class="odd gradeX">
                                            <td><a href="{{url('jobs/'.$job->job_id)}}">{{$job->job_id}}</a></td>
                                            <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->cname}}</a></td>
                                            <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->reg_no}}</a></td>
                                            <td><a href="{{url('jobs/'.$job->job_id)}}">{{$job->promised_date}}</a></td>
                                            <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->sname}}</a></td>
                                            <td class="text-center">
                                                @if($job->status == 'complete')
                                                    <span class="status-label label label-success">Complete</span>
                                                @elseif($job->status == 'open')
                                                    <span class="status-label label label-warning">Open</span>
                                                @elseif($job->status == 'job_done')
                                                    <span class="status-label label label-info">Job Done</span>
                                                @endif
                                            </td>
                                            <td class="text-center actions">
                                                <a href="{{url('jobs/'.$job->job_id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                                <a href="{{url('download_job/'.$job->job_id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                <a href="{{url('print_job/'.$job->job_id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="open">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Open Jobs Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-function1">
                                    <thead>
                                    <tr>
                                        <th>Job #</th>
                                        <th>Customer</th>
                                        <th>Vehicle</th>
                                        <th>Promised Date</th>
                                        <th>S.Advisor</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jobs as $job)
                                        @if($job->status == "open")
                                        <tr class="odd gradeX">
                                            <td><a href="{{url('jobs/'.$job->job_id)}}">{{$job->job_id}}</a></td>
                                            <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->cname}}</a></td>
                                            <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->reg_no}}</a></td>
                                            <td><a href="{{url('jobs/'.$job->job_id)}}">{{$job->promised_date}}</a></td>
                                            <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->sname}}</a></td>
                                            <td><span class="status-label label label-warning">Open</span></td>
                                            <td class="text-center actions">
                                                <a href="{{url('jobs/'.$job->job_id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                                <a href="{{url('download_job/'.$job->job_id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                <a href="{{url('print_job/'.$job->job_id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="job_done">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Job Done Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-function2">
                                    <thead>
                                    <tr>
                                        <th>Job #</th>
                                        <th>Customer</th>
                                        <th>Vehicle</th>
                                        <th>Promised Date</th>
                                        <th>S.Advisor</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jobs as $job)
                                        @if($job->status == "job_done")
                                            <tr class="odd gradeX">
                                                <td><a href="{{url('jobs/'.$job->job_id)}}">{{$job->job_id}}</a></td>
                                                <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->cname}}</a></td>
                                                <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->reg_no}}</a></td>
                                                <td><a href="{{url('jobs/'.$job->job_id)}}">{{$job->promised_date}}</a></td>
                                                <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->sname}}</a></td>
                                                <td><span class="status-label label label-info">Job Done</span></td>
                                                <td class="text-center actions">
                                                    <a href="{{url('jobs/'.$job->job_id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                                    <a href="{{url('download_job/'.$job->job_id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                    <a href="{{url('print_job/'.$job->job_id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                                    <a href="{{url('invoices/new_job_invoice/'.$job->job_id)}}"  title="Create Invoice"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="complete">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Completed Jobs Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-function3">
                                    <thead>
                                    <tr>
                                        <th>Job #</th>
                                        <th>Customer</th>
                                        <th>Vehicle</th>
                                        <th>Promised Date</th>
                                        <th>S.Advisor</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jobs as $job)
                                        @if($job->status == "complete")
                                            <tr class="odd gradeX">
                                                <td><a href="{{url('jobs/'.$job->job_id)}}">{{$job->job_id}}</a></td>
                                                <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->cname}}</a></td>
                                                <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->reg_no}}</a></td>
                                                <td><a href="{{url('jobs/'.$job->job_id)}}">{{$job->promised_date}}</a></td>
                                                <td><a href="{{url('jobs/'.$job->job_id)}}" class="uppercase">{{$job->sname}}</a></td>
                                                <td><span class="status-label label label-success">Complete</span></td>
                                                <td class="text-center actions">
                                                    <a href="{{url('jobs/'.$job->job_id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                                    <a href="{{url('download_job/'.$job->job_id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                    <a href="{{url('print_job/'.$job->job_id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->










@endsection