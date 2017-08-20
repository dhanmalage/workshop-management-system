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

<div class="page">
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4 class="supplementary-print-title">Supplementary Estimate</h4>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover uppercase">
                    <thead>
                    <tr>
                        <th>S. No</th>
                        <th>Description</th>
                        <th>Units</th>
                        <th>Rate</th>
                        <th class="text-center">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($supplementary_estimate_details as $detail)
                        <tr class="print-tr">
                            <td>
                                <?php echo $i; ?>
                            </td>
                            <td>{{$detail->item_description}}</td>
                            <td>{{$detail->units}}</td>
                            <td>{{$detail->rate}}</td>
                            <td>{{$detail->initial_amount}}</td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="row estimate-print-footer">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
            <p><strong>Net Amount: </strong>Rs. {{$supplementary_estimates->net_amount}}</p>
        </div>
    </div>

    <div class="row estimate-print-footer">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
            <p><strong>Grand Total: </strong>Rs. {{$job->grand_total}}</p>
        </div>
    </div>

    <div class="row estimate-print-footer">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>Cost of parts will be charged extra. If any other works or parts are found necessary
                in the course of our work in your vehicle, a supplementary will be furnished for your approval.</p>
        </div>
    </div>

    <div class="row estimate-print-footer">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <p><strong>Customer's Approval</strong></p>
            <p>Signature:</p>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <p><strong>For KENTARO AUTO ENGINEERING</strong></p>
            <p>Signature:</p>
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

