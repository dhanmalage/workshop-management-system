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

    <!-- DataTables CSS -->
    <link href="{{url('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
   <!-- <link href="{{url('bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="{{url('dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('css/styles.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{url('css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{url('css/chosen.min.css')}}" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">KENTARO Admin v1.0</a>
            </div>
    
            <!-- /.navbar-header -->
            @include('topbar')
            
            <!-- /.navbar-sidebar -->
            @include('sidebar')
        </nav>

        <div id="page-wrapper">
            
            <!-- /.row -->
            @yield('content')
           
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{url('bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{url('bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('dist/js/sb-admin-2.js')}}"></script>

    <script src="{{url('js/bootstrap-datepicker.min.js')}}"></script>

    <script src="{{url('js/chosen.jquery.min.js')}}"></script>

    <!-- <script src="{{url('js/loader.js')}}"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="{{url('js/functions.js')}}"></script>

    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    

</body>

</html>
