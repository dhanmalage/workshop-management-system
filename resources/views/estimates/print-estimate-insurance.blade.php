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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 estimate-print-title">
            <h4>Estimate</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-default panel-print">
                <div class="panel-body">
                    <p><strong>Department: </strong>{{$department->name}}</p>
                    <p><strong>Customer Details:</strong></p>
                    <p><strong>Name: </strong>{{$customer->name}}</p>
                    <p><strong>Address: </strong>{{$customer->address1}}, {{$customer->address2}}, {{$customer->city}}</p>
                    <p><strong>Tel: </strong>{{$customer->telephone}} <strong>Mobile: </strong>{{$customer->mobile}}</p>
                    <p><strong>Fax: </strong>{{$customer->fax}}</p>
                    @if(isset($insurance_company))
						@if($insurance_company->name == 'Personal')
							<p><strong>Estimate Type: </strong>                    
								{{$insurance_company->name}}                    
							</p>
						@else
							<p><strong>Insurance: </strong>                    
								{{$insurance_company->name}}                    
							</p>
                            <p><strong>Address: </strong>
                                {{$insurance_company->address}}
                            </p>
							@if($insurance_company->vat_no != null)
                            <p><strong>VAT No: </strong>
                                {{$insurance_company->vat_no}}
                            </p>
							@endif
						@endif
					@endif
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-default panel-print">
                <div class="panel-body">
                    <p><strong>Estimate No: </strong>KAE/EST/{{$estimate->id}}</p>
                    <p><strong>Vehicle Details:</strong></p>
                    <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
                    <p><strong>Make: </strong>{{$vehicle->make}}</p>
                    <p><strong>Model: </strong>{{$vehicle->model}}</p>
                    <p><strong>Chasis No: </strong>{{$vehicle->chasis_no}}</p>
                    <p><strong>Mileage In: </strong>{{$estimate->mileage_in}}</p>
                    <p><strong>Estimate Date: </strong>{{$estimate->created_at->format('Y-m-d')}}</p>
                </div>
            </div>
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


                    @if($services_count > 0)
                        <tr><td colspan="5"><strong>Services</strong></td>
                    @endif

                    <?php $i = 1; ?>
                    @foreach($estimate_details as $detail)
                        @if($detail->type == "service")
                            <tr class="print-tr">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>{{$detail->item_description}}</td>
                                <td>{{$detail->units}}</td>
                                <td>{{$detail->rate}}</td>
								<td class="service-cost">{{$detail->approved_amount}}</td>
                            </tr>
                            <?php $i++ ?>
                        @endif
                    @endforeach

                    @if($parts_count > 0)
                        <tr><td colspan="5"><strong>Parts</strong></td>
                    @endif

                    @foreach($estimate_details as $detail)
                        @if($detail->type == "part")
                            <tr class="print-tr">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>{{$detail->item_description}}</td>
                                <td>{{$detail->units}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $i++ ?>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="row estimate-print-footer">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
            <p><strong id="insurancetot">Net Amount: </strong></p>
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
	
	<script> 
		$(document).ready(function() {
			var insurance_est_sum = 0;
			$('.service-cost').each(function(){
				if(!isNaN(parseFloat($(this).text()))){
					insurance_est_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
				}

			});
			console.log(insurance_est_sum);
			$('#insurancetot').after("Rs. " + insurance_est_sum.toFixed(2));
		});
	</script>
	
</footer>

</body>
</html>

