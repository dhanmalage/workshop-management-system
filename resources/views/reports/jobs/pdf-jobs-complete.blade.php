<!DOCTYPE html>
<html>
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

</head>
<body>

<div class="row">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        <img src="{{url('images/logo.gif')}}">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
        <div class="text-right">
            <p><strong>No 395, Colombo Road, Boralesgamuwa Pepiliyana.</strong></p>
            <p>Tel: +94112890676/7 | F: 112890675</p>
            <p>info@kentaro.lk | www.kentaro.lk</p>
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <h4>Completed Jobs</h4>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        @if(isset($date1) && isset($date2))
            (<strong>From </strong>{{$date1}} <strong>To </strong>{{$date2}})
        @endif
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Job #</th>
                    <th>Customer</th>
                    <th>Vehicle</th>
                    <th>Promised Date</th>
                    <th>Grand Total</th>
                    <th>S.Advisor</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jobs as $job)
                    <tr class="odd gradeX">
                        <td>Job # {{$job->job_id}}</td>
                        <td>{{$job->cname}}</td>
                        <td>{{$job->reg_no}}</td>
                        <td>{{$job->promised_date}}</td>
                        <td>{{$job->grand_total}}</td>
                        <td>{{$job->sname}}</td>
                        <td>{{$job->job_date}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
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
</footer>

</body>
</html>