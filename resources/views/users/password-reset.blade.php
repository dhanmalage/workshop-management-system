@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Change Password</h3>
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-9">

        </div>
        <!-- /.col-lg-3 -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Change Password
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    @if(isset($success))
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 alert alert-sucess">
                                <ul>
                                        <li>Successfully updated</li>
                                </ul>
                            </div>
                        </div>
                    @endif

                        @if(isset($fail))
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 alert alert-danger">
                                    <ul>
                                            <li>Please try again</li>
                                    </ul>
                                </div>
                            </div>
                        @endif


                    {!! Form::open(array('url' => url('password-update'), 'class'=>'form-horizontal')) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Current', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::password('current_password', array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'New', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::password('new_password', array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('rate', 'Re-type new', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
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