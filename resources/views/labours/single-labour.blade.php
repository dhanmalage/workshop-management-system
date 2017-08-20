@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Job Labour Details</h3>
        </div>
        <div class="col-lg-8">

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Customer Details:</strong></div>
                <div class="panel-body">
                    <p><a href="{{url('estimates/'.$estimate->id)}}"><strong>Estimate #: </strong>{{$estimate->id}}</a></p>
                    <p><a href="{{url('jobs/'.$job->id)}}"><strong>Job #: </strong>{{$job->id}}</a></p>
                    <p><a href="{{url('customers/'.$customer->id)}}"><strong>Customer Name: </strong>{{$customer->name}}</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Vehicle Details:</strong></div>
                <div class="panel-body">
                    <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
                    <p><strong>Make: </strong>{{$vehicle->make}}</p>
                    <p><strong>Model: </strong>{{$vehicle->model}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Estimate Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Role</th>
                                <th>Normal</th>
                                <th>OT</th>
                                <th>Dub. OT</th>
                                <th>Other</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($labour_details as $labour_detail)
                                <tr class="odd gradeX">
                                    <td>{{$labour_detail->name}}</td>
                                    <td>{{$labour_detail->role}}</td>
                                    <td>{{$labour_detail->normal_hrs}} : {{$labour_detail->normal_min}}</td>
                                    <td>{{$labour_detail->ot_hrs}} : {{$labour_detail->ot_min}}</td>
                                    <td>{{$labour_detail->dot_hrs}} : {{$labour_detail->dot_min}}</td>
                                    <td>{{$labour_detail->other_hrs}} : {{$labour_detail->other_min}}</td>
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