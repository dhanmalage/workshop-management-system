@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Edit User</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('users')}}" type="button" class="page-header btn btn-primary">All Users</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit User Data Form
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    @if($errors->any())
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {!! Form::model($user, ['action' => ['UsersController@update', $user->id], 'role' => 'form', 'method' => 'PATCH', 'class'=>'form-horizontal']) !!}

                    <div class="row">
                        <div class="col-lg-8">

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
                                <div class="col-sm-offset-4 col-sm-8">
                                    {!! Form::submit('Update User', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>

                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
