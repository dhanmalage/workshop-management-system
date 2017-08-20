@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Add New Purchase Order</h3>
        </div>
        <div class="col-lg-8">
            <a href="{{url('orders')}}" type="button" class="page-header btn btn-primary">All Purchase Orders</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Purchase Order Data Form
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

                    {!! Form::open(array('url' => url('orders'), 'class'=>'form-horizontal')) !!}
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group">
                                {!! Form::label('supplier', 'Supplier', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('supplier_id', ['' => 'Select a supplier'] + $suppliers, null, array('class' => 'form-control', 'id' => 'supplier', 'required')) !!}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-5">

                        </div>
                    </div>

                    <div class="row add-estimate-item-section">
                        <div class="col-lg-12" id="estmate-items-wrapper">
                            <table class="table table-bordered" id="dynamic-tbl">
                                <thead>
                                <th class="item-select">Item</th>
                                <th class="item-desc">Description</th>
                                <th class="item-qty">Quantity</th>
                                <th class="item-amount">Price</th>
                                <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                <tr id="1">
                                    <td>
                                        {!! Form::select('item_id[]', ['' => 'Select an item'] + $items, null, array('class' => 'form-control itemId itemIdFirst', 'id' => 'itemId', 'required')) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('item_description[]', null, ['class' => 'form-control item_description', 'id' => 'item_description', 'placeholder' => 'Detailed Description', 'required']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('quantity[]', null, ['class' => 'form-control', 'placeholder' => 'Add Quantity', 'id' => 'quantity', 'required']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('price[]', null, ['class' => 'form-control price', 'placeholder' => 'Add Price', 'id' => 'price', 'required']) !!}
                                    </td>
                                    <td class="text-center actions"><a id="delete-row" href="#"><i class="fa fa-times"></i></a></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1">
                            <button class="btn btn-primary" type="button" class="addRow" id="addOrderRow">add row</button>
                        </div>
                        <div class="col-lg-3">
                            <!--<button class="btn btn-info" type="button" onclick="calcTotal($('#dynamic-tbl'));" class="addRow" id="addRow">Calculate Total</button>-->
                            {!! Form::submit('Save Order', ['class' => 'btn btn-success']) !!}
                            <button class="btn btn-default" type="button" onclick="calcOrderTotal($('#dynamic-tbl'));" class="addRow" id="addRow">Calculate Total</button>
                        </div>

                        <div class="col-lg-1 text-right">

                            <p class="estimate-total"><strong>Total: </strong></p>
                        </div>
                        <div class="col-lg-2">
                            {!! Form::text('total', null, ['class' => 'form-control text-right total', 'id' => 'order-total', 'readonly']) !!}
                        </div>
                        <div class="col-lg-3">

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