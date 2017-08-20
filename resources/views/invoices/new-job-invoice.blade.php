@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">New Direct Invoice</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('invoices')}}" type="button" class="page-header btn btn-primary"> All Invoices</a>
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
                    <p><strong>Insurance Company: </strong>{{$insurance_company->name}}</p>
                    <p><strong>Estimate No: </strong>{{$estimate->id}}</p>
                    <p><strong>Estimate Create Date: </strong>{{$estimate->created_at}}</p>
                    <p><strong>Job No: </strong>{{$job->id}}</p>
                    <p><strong>Job Create Date: </strong>{{$job->created_at}}</p>
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
                    <p><strong>Mileage In: </strong>{{$estimate->mileage_in}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <span class="hide" id="nbtValue">{{$nbt->tax_value}}</span>
    <span class="hide" id="vatValue">{{$vat->tax_value}}</span>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                {!! Form::open(array('url' => url('invoices/save_invoice'), 'class'=>'', 'id' => '')) !!}
                {!! Form::hidden('job_id', $job->id) !!}
                    <div class="panel-heading">
                        Invoice Data Form
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                            <div class="row add-estimate-item-section">
                                <div class="col-lg-12" id="invoice-save-wrapper">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Item</th>
                                            <th>No.</th>
                                            <th>Rate</th>
                                            <th>NBT</th>
                                            <th>VAT</th>
                                            <th>Amount</th>
                                        </thead>
                                        <tbody>
                                            @foreach($job_details as $detail)
                                                <tr>
                                                    <td>
                                                        {{$detail->item_description}}
                                                    </td>
                                                    <td>
                                                        {{$detail->units}}
                                                    </td>
                                                    <td>
                                                        {{$detail->rate}}
                                                    </td>
                                                        {!! Form::hidden('job_detail_id[]', $detail->id, ['class' => 'invoice_job_detail_id', 'placeholder' => '']) !!}
                                                        {!! Form::hidden('item_id[]', $detail->item_id, ['class' => 'invoice_item_id', 'placeholder' => '']) !!}
                                                    <td>
                                                        {!! Form::checkbox('nbt[]', 1, null, ['class' => 'checkbox-invoice-nbt']) !!}
                                                        {!! Form::hidden('nbt_check[]', 0, ['class' => 'invoice-nbt-check', 'placeholder' => '']) !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::checkbox('vat[]', 1, null, ['class' => 'checkbox-invoice-vat']) !!}
                                                        {!! Form::hidden('vat_check[]', 0, ['class' => 'invoice-vat-check', 'placeholder' => '']) !!}
                                                    </td>
                                                    <td>
                                                        <span class="hide line-amount-fixed">{{$detail->approved_amount}}</span>
                                                        <span class="line-amount">{{$detail->approved_amount}}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    </div>

                    <div class="modal-footer">

                        {!! Form::submit('Save Invoice', ['class' => 'btn btn-primary']) !!}

                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection