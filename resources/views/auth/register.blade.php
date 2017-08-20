<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kentaro - Admin v1.0</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
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
                        
                        
                        
                        
                        {!! Form::open(array('url' => url('auth/register'), 'class'=>'form-horizontal')) !!}
                        {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    Name
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                </div>

                                <div>
                                    Email
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                                </div>

                              <div class="form-group">
                                    Password
                                    <input class="form-control" type="password" name="password">
                                </div>

                               <div class="form-group">
                                    Confirm Password
                                    <input class="form-control" type="password" name="password_confirmation">
                                </div>

                               <div class="form-group">
                                    <button type="submit">Register</button>
                                </div>
                            </fieldset>
                        {!! Form::close() !!}
                        

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{url('bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('dist/js/sb-admin-2.js')}}"></script>

</body>

</html>
