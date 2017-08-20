@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">All Employee Roles</h3>
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-9">

        </div>
        <!-- /.col-lg-3 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Employee Role Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Role Name</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr class="odd gradeX">
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->role}}</td>
                                    <td class="text-center actions">
                                        <a href="{{url('employee_roles/'.$role->id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
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