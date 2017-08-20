@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Invoices</h3>
        </div>
        <div class="col-lg-9">
            <!--
            <a href="{{url('invoices/create')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-share fa-fw"></i> New Job Invoice</a>
            -->
            <a href="{{url('direct_invoices/create')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-share fa-fw"></i> New Direct Invoice</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a type="button" class="btn btn-primary" href="#job" aria-controls="job" role="tab" data-toggle="tab">Job Invoices</a></li>
                <li role="presentation"><a type="button" class="btn btn-primary" href="#direct" aria-controls="direct" role="tab" data-toggle="tab">Direct Invoices</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane fade in active" id="job">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Job Invoices Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
								<th>#</th>
                                <th>Invoice #</th>
                                <th>Job #</th>
                                <th>Vehicle</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($invoices as $invoice)
                                <tr class="odd gradeX">
									<td><a href="{{url('invoices/'.$invoice->id)}}" title="View">{{ $i }}</a></td>
                                    <td><a href="{{url('invoices/'.$invoice->id)}}" title="View">KAE/J-INV/{{$invoice->id}}</a></td>
                                    <td><a href="{{url('invoices/'.$invoice->id)}}" title="View">JOB # {{$invoice->job_id}}</a></td>
                                    <td><a href="{{url('invoices/'.$invoice->id)}}" title="View">{{$invoice->vehicle_reg}}</a></td>
                                    <td><a href="{{url('invoices/'.$invoice->id)}}" title="View">{{$invoice->total_pay}}</a></td>
                                    <td><a href="{{url('invoices/'.$invoice->id)}}" title="View">{{$invoice->created_at}}</a></td>
                                    <td class="text-center actions">
                                        <a href="{{url('invoices/'.$invoice->id)}}" title="View"><i class="fa fa-newspaper-o"></i></a>
                                        <a href="{{url('download_invoice/'.$invoice->id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="{{url('print_invoice/'.$invoice->id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                        <a href="{{url('dot_print_invoice/'.$invoice->id)}}"  title="Print" target="_blank"><strong>.dot</strong></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>

                <div role="tabpanel" class="tab-pane fade in" id="direct">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Direct Invoices Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-function1">
                                    <thead>
                                    <tr>
										<th>#</th>
                                        <th>Invoice #</th>
                                        <th>Type</th>
                                        <th>Customer</th>
                                        <th>Vehicle</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($direct_invoices as $direct_invoice)
                                        <tr class="odd gradeX">
											<td><a href="{{url('direct_invoices/'.$direct_invoice->din_id)}}" title="View">{{ $i }}</a></td>
                                            <td><a href="{{url('direct_invoices/'.$direct_invoice->din_id)}}" title="View">KAE/D-INV/{{$direct_invoice->din_id}}</a></td>
                                            <td><a href="{{url('direct_invoices/'.$direct_invoice->din_id)}}" title="View">{{$direct_invoice->invoice_type}}</a></td>
                                            <td><a href="{{url('direct_invoices/'.$direct_invoice->din_id)}}" title="View">{{$direct_invoice->cname}}</a></td>
                                            <td><a href="{{url('direct_invoices/'.$direct_invoice->din_id)}}" title="View">{{$direct_invoice->reg_no}}</a></td>
                                            <td><a href="{{url('direct_invoices/'.$direct_invoice->din_id)}}" title="View">{{$direct_invoice->total_pay}}</a></td>
                                            <td><a href="{{url('direct_invoices/'.$direct_invoice->din_id)}}" title="View">{{$direct_invoice->din_date}}</a></td>
                                            <td class="text-center actions">
                                                <a href="{{url('direct_invoices/'.$direct_invoice->din_id)}}" title="View"><i class="fa fa-newspaper-o"></i></a>
                                                <a href="{{url('download_direct_invoice/'.$direct_invoice->din_id)}}"  title="Download PDF"><i class="fa fa-file-pdf-o"></i></a>
                                                <a href="{{url('print_direct_invoice/'.$direct_invoice->din_id)}}"  title="Print" target="_blank"><i class="fa fa-print"></i></a>
                                                <a href="{{url('dot_print_direct_invoice/'.$direct_invoice->din_id)}}"  title="Print" target="_blank"><strong>.dot</strong></a>
                                                @role('owner')
                                                <a href="{{url('delete_confirm_direct_invoice/'.$direct_invoice->din_id)}}" class="delete-icon" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                @endrole
                                            </td>
                                        </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        </div>
    </div>
@endsection