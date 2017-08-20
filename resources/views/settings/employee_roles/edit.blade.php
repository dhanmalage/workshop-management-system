@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Edit Department</h3>
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-9">

        </div>
        <!-- /.col-lg-3 -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Department Form
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    @if($errors->any())
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {!! Form::model($employee_role, ['action' => ['EmployeeRolesController@update', $employee_role->id], 'role' => 'form', 'method' => 'PATCH', 'class'=>'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Role Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('role', null, ['class' => 'form-control', 'placeholder' => 'Employee Role']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-4">
                                {!! Form::submit('Save Role', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
        <div class="col-lg-4">

        </div>
    </div>
@endsection