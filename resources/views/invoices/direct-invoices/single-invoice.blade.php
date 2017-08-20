@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Direct Invoice Details</h3>
        </div>
        <div class="col-lg-8">
            <a href="{{url('download_direct_invoice/'.$invoice->id)}}" type="button" class="page-header btn btn-primary"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
            <a href="{{url('print_direct_invoice/'.$invoice->id)}}" target="_blank" type="button" class="page-header btn btn-primary"><i class="fa fa-print"></i> Print Invoice</a>
            <a href="{{url('dot_print_direct_invoice/'.$invoice->id)}}" target="_blank" type="button" class="page-header btn btn-primary"><i class="fa fa-print"></i> Print DOT Matrix</a>
            @role('owner')
            <a href="{{url('delete_confirm_direct_invoice/'.$invoice->id)}}" type="button" class="page-header btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
            @endrole
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Customer Details:</strong></div>
                <div class="panel-body">
                    <p><strong>Name: </strong>{{$customer->name}}</p>
                    <p><strong>Address: </strong>{{$customer->address1}},{{$customer->address2}},{{$customer->city}}</p>
                    <p><strong>Tel: </strong>{{$customer->telephone}} <strong>Mobile: </strong>{{$customer->mobile}}</p>
                    <p><strong>Fax: </strong>{{$customer->fax}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Vehicle Details:</strong></div>
                <div class="panel-body">
                    <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
                    <p><strong>Make: </strong>{{$vehicle->make}}</p>
                    <p><strong>Model: </strong>{{$vehicle->model}}</p>
                    <p><strong>Chasis No: </strong>{{$vehicle->chasis_no}}</p>
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
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover uppercase" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>VAT</th>
                                <th>NBT</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($invoice_details as $detail)
                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>{{$detail->item_description}}</td>
                                    <td>{{$detail->units}}</td>
                                    <td>{{$detail->initial_amount}}</td>
                                    <td class="row-vat">{{$detail->vat_value}}</td>
                                    <td class="row-nbt">{{$detail->nbt_value}}</td>
                                    <td>{{$detail->pay_amount}}</td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <diqv class="col-lg-3">
            <div class="alert alert-info">
                <span class="alert-link">VAT: </span>
                {{$invoice->vat_value}}%
            </div>
            <div class="alert alert-info">
                <span class="alert-link">NBT: </span>
                {{$invoice->nbt_value}}%
            </div>
        </diqv>
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
                <span class="alert-link">Total: </span>Rs. {{$invoice->total_pay}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning">
                <p><strong>Remarks: </strong>{{$invoice->remarks}}</p>
            </div>
        </div>
    </div>


@endsection