@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Add GRN</h3>
        </div>
        <div class="col-lg-8">

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    GRN Data Form
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    @if($errors->any())
                        <div class="form-group">
                            <div class="col-sm-12 alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {!! Form::open(array('url' => url('gen'), 'class'=>'form-horizontal')) !!}

                    {!! Form::hidden('estimate_id', $order->id, ['class' => 'form-control']) !!}

                    <div class="row add-estimate-item-section">
                        <div class="col-lg-12" id="estmate-items-wrapper">
                            <table class="table table-bordered" id="dynamic-tbl">
                                <thead>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                </thead>
                                <tbody>
                                @foreach($order_details as $order_detail)
                                <tr id="1">
                                    <td>
                                        {!! Form::text('item_id[]', $order_detail->item_id, ['class' => 'form-control', 'id' => 'item_id', 'required']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('item_description[]', $order_detail->item_description, ['class' => 'form-control item_description', 'id' => 'item_description', 'placeholder' => 'Detailed Description', 'required']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('quantity[]', $order_detail->quantity, ['class' => 'form-control', 'placeholder' => 'Add Quantity', 'id' => 'quantity', 'required']) !!}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <button class="btn btn-primary" type="button" class="addRow" id="addRow">add row</button>
                        </div>
                        <div class="col-lg-4">
                            {!! Form::submit('Save Estimate', ['class' => 'btn btn-success']) !!}
                            <button class="btn btn-default" type="button" onclick="calcTotal($('#dynamic-tbl'));" class="addRow" id="addRow">Calculate Total</button>
                        </div>

                        <div class="col-lg-1 text-right">
                            <p class="estimate-total"><strong>Total: </strong></p>
                        </div>
                        <div class="col-lg-2">
                            {!! Form::text('net_amount', null, ['class' => 'form-control text-right total', 'id' => 'total', 'readonly']) !!}
                        </div>
                        <div class="col-lg-2">

                        </div>
                        <div class="col-lg-1">
                            {!! Form::reset('Reset Form', ['class' => 'btn btn-danger']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection