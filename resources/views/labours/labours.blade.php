@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Job Labour Details</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('labours/create')}}" type="button" class="page-header btn btn-primary">New Labour</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Labour Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Job #</th>
                                <th>Estimate #</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($labours as $labour)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('labours/'.$labour->labour_id)}}" title="View">{{$labour->labour_id}}</a></td>
                                    <td><a href="{{url('jobs/'.$labour->job_id)}}">{{$labour->job_id}}</a></td>
                                    <td><a href="{{url('estimates/'.$labour->est_id)}}">{{$labour->est_id}}</a></td>
                                    <td class="text-center">
                                        @if($labour->labour_status == 'complete')
                                            <span class="status-label label label-success">Complete</span>
                                        @elseif($labour->labour_status == 'open')
                                            <span class="status-label label label-warning">Open</span>
                                        @endif
                                    </td>
                                    <td class="text-center actions">
                                        <a href="{{url('labours/'.$labour->labour_id)}}" title="View"><i class="fa fa-newspaper-o"></i></a>
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