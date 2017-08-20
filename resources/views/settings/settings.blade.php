@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">System Settings</h3>
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-9">

        </div>
        <!-- /.col-lg-3 -->
    </div>
    <!-- /.row -->

<div class="row">

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Departments
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="{{url('departments')}}" class="btn btn-primary btn-block">View Departments</a>
                <a href="{{url('departments/create')}}" class="btn btn-primary btn-block">Add Departments</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Item Categories
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="{{url('item_categories')}}" class="btn btn-primary btn-block">View Categories</a>
                <a href="{{url('item_categories/create')}}" class="btn btn-primary btn-block">Add Categories</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Estimate Types
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="{{url('estimate_types')}}" class="btn btn-primary btn-block">View Estimate Types</a>
                <a href="{{url('estimate_types/create')}}" class="btn btn-primary btn-block">Add Type</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Employee Roles
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="{{url('employee_roles')}}" class="btn btn-primary btn-block">View Employee Roles</a>
                <a href="{{url('employee_roles/create')}}" class="btn btn-primary btn-block">Add Employee Role</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Employees
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="{{url('employees')}}" class="btn btn-primary btn-block">View Employees</a>
                <a href="{{url('employees/create')}}" class="btn btn-primary btn-block">Add Employee</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Insurance Companies
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="{{url('insurance_companies')}}" class="btn btn-primary btn-block">View Insurance Companies</a>
                <a href="{{url('insurance_companies/create')}}" class="btn btn-primary btn-block">Add Insurance Companies</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Taxes
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="{{url('taxes')}}" class="btn btn-primary btn-block">View Tax Data</a>
                <a href="{{url('taxes/create')}}" class="btn btn-primary btn-block">Add Tax Data</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>

    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text-o fa-fw"></i> Invoice Types
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <a href="{{url('invoice_types')}}" class="btn btn-primary btn-block">View Invoice Types</a>
                <a href="{{url('invoice_types/create')}}" class="btn btn-primary btn-block">Add Invoice Type</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>

</div>
@endsection