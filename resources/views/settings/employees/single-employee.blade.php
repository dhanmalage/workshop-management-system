@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Customer Details</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('employees')}}" type="button" class="page-header btn btn-primary">All Employees</a>
            <a href="{{url('employees/'.$employee->id.'/edit')}}" type="button" class="page-header btn btn-primary">Edit Employee</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$employee->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{url('images/avatar_640.png')}}" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td>{{$employee->name}}</td>
                                </tr>
                                <tr>
                                    <td>Role:</td>
                                    <td>{{$role->role}}</td>
                                </tr>
                                @role('owner')
                                <tr>
                                    <td>Rate:</td>
                                    <td>{{$employee->rate}}</td>
                                </tr>
                                <tr>
                                    <td>OT Rate:</td>
                                    <td>{{$employee->ot_rate}}</td>
                                </tr>
                                <tr>
                                    <td>Double OT Rate:</td>
                                    <td>{{$employee->double_ot_rate}}</td>
                                </tr>
                                <tr>
                                    <td>Other Rate:</td>
                                    <td>{{$employee->other}}</td>
                                </tr>
                                @endrole
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>


@endsection