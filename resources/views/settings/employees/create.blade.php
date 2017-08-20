@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Add Employee</h3>
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
                    Add Employee Form
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

                    {!! Form::open(array('url' => url('employees'), 'class'=>'form-horizontal')) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('role', 'Role', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::select('role_id', ['' => 'Select a role'] + $roles, null, ['class' => 'form-control itemId', 'id' => 'role_id', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('rate', 'Normal Rate', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('rate', null, ['class' => 'form-control', 'placeholder' => 'Normal Rate', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('ot_rate_label', 'OT Rate', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('ot_rate', null, ['class' => 'form-control', 'placeholder' => 'OT Rate']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('dot_rate_label', 'Double OT Rate', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('double_ot_rate', null, ['class' => 'form-control', 'placeholder' => 'Double OT Rate']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('other_rate_label', 'Other Rate', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('other', null, ['class' => 'form-control', 'placeholder' => 'Other Rate']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                            {!! Form::submit('Save Employee', ['class' => 'btn btn-primary']) !!}
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