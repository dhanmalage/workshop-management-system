@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Invoice Details</h3>
        </div>
        <div class="col-lg-8">
            <a href="{{url('download_invoice/'.$invoice->id)}}" type="button" class="page-header btn btn-primary"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
            <a href="{{url('print_invoice/'.$invoice->id)}}" target="_blank" type="button" class="page-header btn btn-primary"><i class="fa fa-print"></i> Print Invoice</a>
            <a href="{{url('dot_print_invoice/'.$invoice->id)}}" target="_blank" type="button" class="page-header btn btn-primary"><i class="fa fa-print"></i> Print DOT Matrix</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-info">
                <span class="alert-link">Department: </span>{{$department->name}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-info">
                <span class="alert-link">Estimate Date: </span>{{$estimate->created_at}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Customer Details:</strong></div>
                <div class="panel-body">
                    <p><strong>Name: </strong>{{$customer->name}}</p>
                    <p><strong>Address: </strong>{{$customer->address1}},{{$customer->address2}},{{$customer->city}}</p>
                    <p><strong>Tel: </strong>{{$customer->telephone}} <strong>Mobile: </strong>{{$customer->mobile}}</p>
                    <p><strong>Fax: </strong>{{$customer->fax}}</p>
                    <p><strong>Email: </strong>{{$customer->email}}</p>
                    <p><strong>Insurance Company: </strong>{{$invoice->insurance_company}}</p>
                    @if($invoice->insurance_address != null)
                        <p><strong>Insurance Address: </strong>{{$invoice->insurance_address}}</p>
                    @endif
                    @if($invoice->insurance_vat_no != null)
                        <p><strong>Insurance VAT No: </strong>{{$invoice->insurance_vat_no}}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Vehicle Details:</strong></div>
                <div class="panel-body">
                    <p><strong>Invoice No: </strong>KAE/J-INV/{{$invoice->id}}</p>
                    <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
                    <p><strong>Make: </strong>{{$vehicle->make}}</p>
                    <p><strong>Model: </strong>{{$vehicle->model}}</p>
                    <p><strong>Chasis No: </strong>{{$vehicle->chasis_no}}</p>
                    <p><strong>Mileage In: </strong>{{$estimate->mileage_in}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Invoice Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body estimate-services-section">
                    <div class="dataTable_wrapper">
                        <h4>Services</h4>
                        <table class="table table-striped table-bordered table-hover uppercase" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Rate</th>
								<th>NBT</th>
                                <th>VAT</th>                                
                                <th class="text-center">Amount</th>
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
                                    <td>{{$detail->approved_amount}}</td>
									<td class="row-nbt">{{$detail->nbt_value}}</td>
                                    <td class="row-vat">{{$detail->vat_value}}</td>									
                                    <td>{{$detail->pay_amount}}</td>
                                </tr>
                                <?php $i++ ?>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="panel-body estimate-parts-section">
                    <div class="dataTable_wrapper">
                        <h4>Parts</h4>
                        <table class="table table-striped table-bordered table-hover uppercase" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Rate</th>
								<th>NBT</th>
                                <th>VAT</th>                                
                                <th class="text-center">Amount</th>
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
                                    <td>{{$detail->approved_amount}}</td>
									<td class="row-nbt">{{$detail->nbt_value}}</td>
                                    <td class="row-vat">{{$detail->vat_value}}</td>                                    
                                    <td>{{$detail->pay_amount}}</td>
                                </tr>
                                <?php $i++ ?>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="alert alert-info">
                <span class="alert-link">VAT: </span>
                {{$invoice->vat_value}}%
            </div>
            <div class="alert alert-info">
                <span class="alert-link">NBT: </span>
                {{$invoice->nbt_value}}%
            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-info">
                <span class="alert-link" id="vat-total">VAT Total: </span>
            </div>
            <div class="alert alert-info">
                <span class="alert-link" id="nbt-total">NBT Total: </span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="alert alert-info">
                <span class="alert-link">Grand Total: </span>
                    Rs. {{$invoice->total_pay}}
            </div>
        </div>
    </div>

@endsection