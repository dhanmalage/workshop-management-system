@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-2">
            <h3 class="page-header">Estimates</h3>
        </div>
        <div class="col-lg-10">
        <a href="{{url('estimates/create')}}" type="button" class="page-header btn btn-primary">New Estimate</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a type="button" class="btn btn-primary" href="#all" aria-controls="all" role="tab" data-toggle="tab">All Estimates</a></li>
                <li role="presentation"><a type="button" class="btn btn-warning" href="#open" aria-controls="open" role="tab" data-toggle="tab">Open Estimates</a></li>
                <li role="presentation"><a type="button" class="btn btn-success" href="#complete" aria-controls="complete" role="tab" data-toggle="tab">Completed Estimates</a></li>
            </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="all">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Estimate Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Department</th>
                                    <th>Net Total</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estimates as $estimate)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->est_id}}</a></td>
                                    <td><a href="{{url('estimates/'.$estimate->est_id)}}" class="uppercase">{{$estimate->cname}}</a></td>
                                    <td><a href="{{url('estimates/'.$estimate->est_id)}}" class="uppercase">{{$estimate->reg_no}}</a></td>
                                    <td><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->dname}}</a></td>
                                    <td class="center"><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->net_amount}}</a></td>
                                    <td class="center"><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->created_at}}</a></td>
                                    <td>
                                        @if($estimate->job_id != null)
                                            <span class="status-label label label-success">Complete</span>
                                        @else
                                            <span class="status-label label label-warning">Open</span>
                                        @endif
                                    </td>
                                    <td class="text-center actions">
                                        <a href="{{url('estimates/'.$estimate->est_id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                        <a href="{{url('jobs/create_job/'.$estimate->est_id)}}" title="Job"><i class="fa fa-briefcase fa-fw"></i></a>
                                        <a title="Edit" href="{{url('estimates/'.$estimate->est_id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{url('download_estimate/'.$estimate->est_id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="{{url('print_estimate/'.$estimate->est_id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                        <a href="{{url('download_estimate_insurance/'.$estimate->est_id)}}"  title="Download Insurance Copy" target="_blank"><i class="fa fa-info" aria-hidden="true"></i></a>
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
            <!-- /. all tab -->

            <div role="tabpanel" class="tab-pane fade in" id="open">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Open Estimate Data
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-function1">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Department</th>
                                    <th>Net Total</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($estimates as $estimate)
                                    @if($estimate->job_id == null)
                                        <tr class="odd gradeX">
                                            <td><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->est_id}}</a></td>
                                            <td><a href="{{url('estimates/'.$estimate->est_id)}}" class="uppercase">{{$estimate->cname}}</a></td>
                                            <td><a href="{{url('estimates/'.$estimate->est_id)}}" class="uppercase">{{$estimate->reg_no}}</a></td>
                                            <td><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->dname}}</a></td>
                                            <td class="center"><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->net_amount}}</a></td>
                                            <td class="center"><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->created_at}}</a></td>
                                            <td>
                                                @if($estimate->job_id != null)
                                                    <span class="status-label label label-success">Complete</span>
                                                @else($job->status == 'open')
                                                    <span class="status-label label label-warning">Open</span>
                                                @endif
                                            </td>
                                            <td class="text-center actions">
                                                <a href="{{url('estimates/'.$estimate->est_id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                                <a href="{{url('jobs/create_job/'.$estimate->est_id)}}" title="Job"><i class="fa fa-briefcase fa-fw"></i></a>
                                                <a title="Edit" href="{{url('estimates/'.$estimate->est_id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{url('download_estimate/'.$estimate->est_id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                <a href="{{url('print_estimate/'.$estimate->est_id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                                <a href="{{url('download_estimate_insurance/'.$estimate->est_id)}}"  title="Download Insurance Copy" target="_blank"><i class="fa fa-info" aria-hidden="true"></i></a>
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
            <!-- /.open tab -->

            <div role="tabpanel" class="tab-pane fade in" id="complete">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Completed Estimate Data
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-function2">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Department</th>
                                    <th>Net Total</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($estimates as $estimate)
                                    @if($estimate->job_id != null)
                                        <tr class="odd gradeX">
                                            <td><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->est_id}}</a></td>
                                            <td><a href="{{url('estimates/'.$estimate->est_id)}}" class="uppercase">{{$estimate->cname}}</a></td>
                                            <td><a href="{{url('estimates/'.$estimate->est_id)}}" class="uppercase">{{$estimate->reg_no}}</a></td>
                                            <td><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->dname}}</a></td>
                                            <td class="center"><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->net_amount}}</a></td>
                                            <td class="center"><a href="{{url('estimates/'.$estimate->est_id)}}">{{$estimate->created_at}}</a></td>
                                            <td>
                                                @if($estimate->job_id != null)
                                                    <span class="status-label label label-success">Complete</span>
                                                @else($job->status == 'open')
                                                    <span class="status-label label label-warning">Open</span>
                                                @endif
                                            </td>
                                            <td class="text-center actions">
                                                <a href="{{url('estimates/'.$estimate->est_id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                                <a href="{{url('jobs/create_job/'.$estimate->est_id)}}" title="Job"><i class="fa fa-briefcase fa-fw"></i></a>
                                                <a title="Edit" href="{{url('estimates/'.$estimate->est_id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{url('download_estimate/'.$estimate->est_id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                <a href="{{url('print_estimate/'.$estimate->est_id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                                <a href="{{url('download_estimate_insurance/'.$estimate->est_id)}}"  title="Download Insurance Copy" target="_blank"><i class="fa fa-info" aria-hidden="true"></i></a>
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
            <!-- /.complete tab -->

        </div>
            <!-- /.tabs -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


@endsection