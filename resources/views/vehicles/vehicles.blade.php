@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-2">
            <h3 class="page-header">Vehicles</h3>
        </div>
        <div class="col-lg-10">
            <a href="{{url('vehicles/create')}}" type="button" class="page-header btn btn-primary">New Vehicle</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Vehicle Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>Reg.No</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Customer</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicles as $vehicle)
                                <tr class="odd gradeX">
                                    <td>{{$vehicle->reg_no}}</td>
                                    <td>{{$vehicle->make}}</td>
                                    <td>{{$vehicle->model}}</td>
                                    <td>{{$vehicle->year}}</td>
                                    <td>{{$vehicle->cname}}</td>
                                    <td class="text-center actions">
                                        <a href="{{url('vehicles/'.$vehicle->vid.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
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
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection