@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">New Invoice</h3>
        </div>
        <div class="col-lg-9">

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Create Invoice:</strong></div>
                <div class="panel-body" id="invoice_create">
                        {!! Form::open(array('url' => url('invoices/new_job_invoice'), 'class'=>'form-horizontal')) !!}
                    <div class="form-group">
                            {!! Form::label('job_no', 'Job # ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::select('job_id', ['' => 'Select a job'] + $jobs, null, array('class' => 'form-control', 'id' => 'invoice_job_id', 'required')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                            {!! Form::label('job_total', 'Invoice Total ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('job_total', null, array('class' => 'form-control', 'id' => 'invoice_job_total', 'placeholder' => 'Invoice Total', 'required')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            {!! Form::text('insurance_pay', null, array('class' => 'form-control', 'placeholder' => 'Insurance Pay')) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('customer_pay', null, array('class' => 'form-control', 'placeholder' => 'Customer Pay')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::textarea('remark', null, array('class' => 'form-control', 'rows' => '4', 'cols' => '50', 'placeholder' => 'Remarks')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::submit('Create Invoice', ['class' => 'btn btn-success btn-block']) !!}
                        </div>
                    </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Job Details:</strong></div>
                <div class="panel-body" id="invoice_job_details">
                    <div class="invoice_job_data">

                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection