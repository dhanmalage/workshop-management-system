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

    <!-- jQuery -->
    <script src="{{url('bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <style type="text/css">

        .row {margin: 0 !important;}
        .spacer{margin-top: 120px;}
		table{text-transform: uppercase;}
        thead { display: table-header-group; margin-top: 200px; }

        tfoot { display: table-row-group; }
        tr { page-break-inside: avoid; }

        .th-space{margin-top: 200px;}

        .pagebreak { page-break-before: always; }
        .sno-width{ width: 55px; }
        h4{text-transform: uppercase;text-align: center;}
		
		@page  
		{ 
			size: auto;   /* auto is the initial value */ 

			/* this affects the margin in the printer settings */ 
			margin: 40mm 5mm 5mm 5mm;  
		} 
		
		.footer-total{ 
			display: block;
			width:100%;      
			margin-top: 70px; 
		}
		.invoice-footer-signature p{ padding-top: 50px; }
        .services-pay{text-align: right;}
        .parts-pay{text-align: right;}
        .services-pay-total{text-align: right;}
        .parts-pay-total{text-align: right;}
        .text-right{text-align: right;}
    </style>

    <script>
        jQuery(document).ready(function(){
            if ($('thead').length > 0) {
                $(this).addClass('th-space');
            }
        });
    </script>
</head>

<body>

<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <p><strong>TAX INVOICE</strong></p>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <p><strong>INVOICE DATE: </strong><?php echo date("Y-m-d"); ?></p>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
        <p><strong>VAT No: </strong>100873184-7000</p>
    </div>

    <hr>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <p><strong>Department: </strong>{{$department->name}}</p>
        <p><strong>Insurance Company: </strong>{{$invoice->insurance_company}}</p>
        @if($invoice->insurance_address != null)
        <p><strong>Insurance Address: </strong>{{$invoice->insurance_address}}</p>
        @endif
        @if($invoice->insurance_vat_no != null)
        <p><strong>Insurance VAT No: </strong>{{$invoice->insurance_vat_no}}</p>
        @endif
        <p><strong>Brought by: </strong>{{$customer->name}}</p>
        <p><strong>Address: </strong>{{$customer->address1}},{{$customer->address2}},{{$customer->city}}</p>
        <p><strong>Tel: </strong>{{$customer->telephone}} <strong>Mobile: </strong>{{$customer->mobile}}</p>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <p><strong>Invoice No: </strong>KAE/J-INV/{{$invoice->id}}</p>
        <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
        <p><strong>Make: </strong>{{$vehicle->make}} - {{$vehicle->model}}</p>
        <p><strong>Chasis No: </strong>{{$vehicle->chasis_no}}</p>
        <p><strong>Mileage In: </strong>{{$estimate->mileage_in}}</p>
        <p><strong>Estimate Date: </strong>{{$estimate->created_at}}</p>
    </div>
</div>

<hr>

@if($services_count > 0)
<div class="row">
    <div class="col-lg-12">

        
            <h4>Services</h4>
		
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="sno-width">S. No</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>NBT</th>
                <th>VAT</th>
                <th class="text-right">Amount</th>
            </tr>
            </thead>
            <tbody>

            <?php $i = 1; ?>
            @foreach($invoice_details as $detail)
                @if($detail->type == "service")
                    <tr class="odd gradeX">
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>{{$detail->item_description}}</td>
                        <td>{{$detail->units}}</td>
                        <td class="services-amount">{{$detail->approved_amount}}</td>
                        <td class="services-row-nbt">{{$detail->nbt_value}}</td>
                        <td class="services-row-vat">{{$detail->vat_value}}</td>
                        <td class="services-pay">{{$detail->pay_amount}}</td>
                    </tr>
                    <?php $i++ ?>
                @endif
            @endforeach
					<tr class="odd gradeX">
                        <td></td>
                        <td colspan="2"><strong>Sub Total</strong></td>
                        <td><strong><span id="services-amount-total"></span></strong></td>
                        <td><strong><span id="services-nbt-total"></span></strong></td>
                        <td><strong><span id="services-vat-total"></span></strong></td>
                        <td class="services-pay-total"><strong><span id="services-pay-total"></span></strong></td>
                    </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
		
    </div>
</div>
@endif



@if($parts_count > 0 && $services_count > 0)
	<div class="pagebreak"> </div>
@endif

@if($parts_count > 0)
<div class="row">
    <div class="col-lg-12">

        
            <h4>Parts</h4>
        

        <table class="table table-hover">
            <thead>
            <tr>
                <th class="sno-width">S. No</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>NBT</th>
                <th>VAT</th>
                <th class="text-right">Amount</th>
            </tr>
            </thead>
            <tbody>

            <?php $i = 1; ?>

            @foreach($invoice_details as $detail)
                @if($detail->type == "part")
                    <tr class="odd gradeX">
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>{{$detail->item_description}}</td>
                        <td>{{$detail->units}}</td>
                        <td class="parts-amount">{{$detail->approved_amount}}</td>
                        <td class="parts-row-nbt">{{$detail->nbt_value}}</td>
                        <td class="parts-row-vat">{{$detail->vat_value}}</td>
                        <td class="parts-pay">{{$detail->pay_amount}}</td>
                    </tr>
                    <?php $i++ ?>
                @endif
            @endforeach
                <tr class="odd gradeX">
                    <td></td>
                    <td colspan="2"><strong>Sub Total</strong></td>
                    <td><strong><span id="parts-amount-total"></span></strong></td>
                    <td><strong><span id="parts-nbt-total"></span></strong></td>
                    <td><strong><span id="parts-vat-total"></span></strong></td>
                    <td class="parts-pay-total"><strong><span id="parts-pay-total"></span></strong></td>
                </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
		
		
		
    </div>
</div>
@endif

<div class="footer-total">

<hr>

    <div class="row estimate-print-footer">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <p><strong>VAT: </strong>{{$invoice->vat_value}}%</p>
            <p><strong>NBT: </strong>{{$invoice->nbt_value}}%</p>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
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
            <p>Authorized Signature</p>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">            
            <p>Authorized Signature</p>
        </div>
    </div>
</div>



<footer>


    <script>
        $(document).ready(function() {
            var ser_vat_sum = 0;
            $('.services-row-vat').each(function(){
                if(!isNaN(parseFloat($(this).text()))){
                    ser_vat_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                }

            });
            $('#services-vat-total').append(ser_vat_sum.toFixed(2));
        });

        $(document).ready(function() {
            var ser_nbt_sum = 0;
            $('.services-row-nbt').each(function(){
                if(!isNaN(parseFloat($(this).text()))){
                    ser_nbt_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                }

            });
            $('#services-nbt-total').append(ser_nbt_sum.toFixed(2));
        });
		
		$(document).ready(function() {
            var ser_amonut_sum = 0;
            $('.services-amount').each(function(){
                if(!isNaN(parseFloat($(this).text()))){
                    ser_amonut_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                }

            });
            $('#services-amount-total').append(ser_amonut_sum.toFixed(2));
        });
		
		$(document).ready(function() {
            var services_sum = 0;
            $('.services-pay').each(function(){
                if(!isNaN(parseFloat($(this).text()))){
                    services_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                }

            });
            $('#services-pay-total').append(services_sum.toFixed(2));
        });


		/* ********************** parts ***************** */

        $(document).ready(function() {
            var par_vat_sum = 0;
            $('.parts-row-vat').each(function(){
                if(!isNaN(parseFloat($(this).text()))){
                    par_vat_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                }

            });
            $('#parts-vat-total').append(par_vat_sum.toFixed(2));
        });

        $(document).ready(function() {
            var par_nbt_sum = 0;
            $('.parts-row-nbt').each(function(){
                if(!isNaN(parseFloat($(this).text()))){
                    par_nbt_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                }

            });
            $('#parts-nbt-total').append(par_nbt_sum.toFixed(2));
        });

        $(document).ready(function() {
            var par_amonut_sum = 0;
            $('.parts-amount').each(function(){
                if(!isNaN(parseFloat($(this).text()))){
                    par_amonut_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                }

            });
            $('#parts-amount-total').append(par_amonut_sum.toFixed(2));
        });

        $(document).ready(function() {
            var parts_sum = 0;
            $('.parts-pay').each(function(){
                if(!isNaN(parseFloat($(this).text()))){
                    parts_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
                }

            });
            $('#parts-pay-total').append(parts_sum.toFixed(2));
        });

    </script>

    <script type="text/javascript">
        window.onload = function() { window.print(); }
    </script>

</footer>

</body>
</html>
