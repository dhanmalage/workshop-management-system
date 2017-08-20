@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Job Consumption Details</h3>
        </div>
        <div class="col-lg-8">
            <a href="{{url('consumptions/create')}}" type="button" class="page-header btn btn-primary">New Consumption</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Consumption Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Job #</th>
                                <th>Vehicle</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($consumptions as $consumption)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('consumptions/'.$consumption->con_id)}}">{{$consumption->con_id}}</a></td>
                                    <td><a href="{{url('jobs/'.$consumption->job_id)}}">{{$consumption->job_id}}</a></td>
                                    <td>{{$consumption->reg_no}}</td>
                                    <td class="text-center">
                                        @if($consumption->consumptions_status == 'complete')
                                            <span class="status-label label label-success">Complete</span>
                                        @elseif($consumption->consumptions_status == 'open')
                                            <span class="status-label label label-warning">Open</span>
                                        @endif
                                    </td>
                                    <td class="text-center actions">
                                        <a href="{{url('consumptions/'.$consumption->con_id)}}" title="View"><i class="fa fa-newspaper-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection