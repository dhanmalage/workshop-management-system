@extends('admin')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-1">

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Create New User</h3>
                    </div>
                    <div class="panel-body">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(array('url' => url('users'), 'class'=>'form-horizontal')) !!}
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group">
                                        {!! Form::label('name', 'Name', ['class' => 'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('role', 'Role', ['class' => 'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::select('role', ['' => 'Select a role'] + $roles ,null , array('class' => 'form-control', 'required')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('email', 'Email', ['class' => 'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('password', 'Password', ['class' => 'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('password_confirm', 'Password Confirm', ['class' => 'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password Confirm']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            {!! Form::submit('Save User', ['class' => 'btn btn-primary']) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection