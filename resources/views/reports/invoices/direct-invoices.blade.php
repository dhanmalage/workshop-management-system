@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Direct Invoices Report</h3>
        </div>
        <div class="col-lg-8">
            {!! Form::open(array('url' => url('reports.direct-invoices'), 'id'=>'report-dates', 'class'=>'form-inline page-header-form')) !!}
            <div class="form-group">
                {!! Form::label('from', 'From', ['class' => 'control-label']) !!}
                {!! Form::text('date1', null, ['class' => 'form-control', 'id' => 'date-pick1', 'placeholder' => 'yyyy/mm/dd']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('to', 'To', ['class' => 'control-label']) !!}
                {!! Form::text('date2', null, ['class' => 'form-control', 'id' => 'date-pick2', 'placeholder' => 'yyyy/mm/dd']) !!}
            </div>
            {!! Form::submit('View Report', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            <div id="submit-alert" class="custom-alert-warning"></div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Direct Invoices Report
                    @if(isset($new_date1_format) && isset($new_date2_format))
                        (<strong>From </strong>{{$new_date1_format}} <strong>To </strong>{{$new_date2_format}})
                        <a href="{{url('reports.download_direct_invoices/'.$new_date1_format.'/'.$new_date2_format)}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF Export</a>
                    @else
                        <a href="{{url('reports.download_direct_invoices/')}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF Export</a>
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>#</th>
								<th>Invoice #</th>
								<th>Type</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Total</th>
								<th>VAT</th>
								<th>NBT</th>
								<th>Pay</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($direct_invoices as $invoice)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('direct_invoices/'.$invoice->inv_id)}}">{{$invoice->inv_id}}</a></td>
									<td><a href="{{url('direct_invoices/'.$invoice->inv_id)}}" title="View">KAE/D-INV/{{$invoice->inv_id}}</a></td>
									<td>{{$invoice->invoice_type}}</td>	
                                    <td>{{$invoice->inv_date}}</td>
                                    <td><a href="{{url('customers/'.$invoice->cid)}}">{{$invoice->cname}}</a></td>
                                    <td>{{$invoice->reg_no}}</td>
									<td>{{$invoice->net_amount}}</td>
									<td>{{$invoice->vat_total}}</td>
									<td>{{$invoice->nbt_total}}</td>
                                    <td>{{$invoice->total_pay}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection