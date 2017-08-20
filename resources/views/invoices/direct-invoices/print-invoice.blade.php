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
        <style type="text/css">
            td.pad-left {
                padding-left: 5px;
            }
            /*
            body{font-size: 17px;}
            .invoice-top-space{height: 150px;}
            */
            .invoice-footer-signature{padding-top: 60px;}
        </style>
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

<div class="invoice-top-space"></div>

<hr>

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p><strong>Customer Details:</strong></p>
                    <p><strong>Name: </strong>{{$customer->name}}</p>
                    <p><strong>Address: </strong>{{$customer->address1}},{{$customer->address2}},{{$customer->city}}</p>
                    <p><strong>Tel: </strong>{{$customer->telephone}} <strong>Mobile: </strong>{{$customer->mobile}}</p>
                    <p><strong>Fax: </strong>{{$customer->fax}}</p>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p><strong>Direct Invoice No: </strong>KAE/D-INV/{{$invoice->id}}</p>
                    <p><strong>Invoice Date: </strong><?php echo date("Y-m-d"); ?></p>
                    <p><strong>Vehicle Details:</strong></p>
                    <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
                    <p><strong>Make: </strong>{{$vehicle->make}}</p>
                    <p><strong>Model: </strong>{{$vehicle->model}}</p>
                    <p><strong>Chasis No: </strong>{{$vehicle->chasis_no}}</p>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover uppercase">
                        <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th class="text-center">Amount</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($services_count > 0)
                            <tr><td colspan="7"><strong>Services</strong></td></tr>
                        @endif

                        <?php $i = 1; ?>
                        @foreach($invoice_details as $detail)
                            @if($detail->type == "service")
                            <tr class="print-tr">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>{{$detail->item_description}}</td>
                                <td>{{$detail->units}}</td>
                                <td class="services-pay">{{$detail->pay_amount}}</td>
                            </tr>
                            <?php $i++ ?>
                            @endif
                        @endforeach
						
						@if($services_count > 0)
							<tr class="odd gradeX">
								<td></td>
								<td><strong>Sub Total</strong></td>
								<td></td>
								<td><strong><span id="services-total"></span></strong></td>
							</tr>
						@endif

                        @if($parts_count > 0)
                            <tr><td colspan="7"><strong>Parts</strong></td></tr>
                        @endif

                        @foreach($invoice_details as $detail)
                            @if($detail->type == "part")
                            <tr class="print-tr">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>{{$detail->item_description}}</td>
                                <td>{{$detail->units}}</td>
                                <td class="parts-pay">{{$detail->pay_amount}}</td>
                            </tr>
                            <?php $i++ ?>
                            @endif
                        @endforeach
						
						@if($parts_count > 0)
							<tr class="odd gradeX">
								<td></td>
								<td><strong>Sub Total</strong></td>
								<td></td>
								<td><strong><span id="parts-total"></span></strong></td>
							</tr>
						@endif
						
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<div class="row estimate-print-footer">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
        <p><strong>Grand Total: </strong>Rs. {{$invoice->total_pay}}</p>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p>Cheques to be drawn in favour of <strong>Kentaro Auto Engineering Pvt Ltd</strong></p>
    </div>
</div>

<div class="row invoice-footer-signature">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
        <hr>
        <p>Authorized Signature</p>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
        <hr>
        <p>Authorized Signature</p>
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

        <script>
			$(document).ready(function() {
				var services_sum = 0;
				$('.services-pay').each(function(){
					if(!isNaN(parseFloat($(this).text()))){
						services_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
					}

				});
				$('#services-total').append(services_sum.toFixed(2));
			});
			
			$(document).ready(function() {
				var parts_sum = 0;
				$('.parts-pay').each(function(){
					if(!isNaN(parseFloat($(this).text()))){
						parts_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
					}

				});
				$('#parts-total').append(parts_sum.toFixed(2));
			});
        </script>

    </footer>

    </body>
</html>

