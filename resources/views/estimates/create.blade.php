@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Add New Estimate</h3>
        </div>
        <div class="col-lg-9">
        <a type="button" class="page-header btn btn-primary" data-toggle="modal" data-target="#addCustomerModel"><i class="fa fa-male"></i> Add Customer</a>
        <a type="button" class="page-header btn btn-primary" data-toggle="modal" data-target="#addItemModel" id="quick-item-btn"><i class="fa fa-cogs fa-fw"></i> Add Item</a>
        <a href="" data-toggle="modal" data-target="#addVehicleModel" type="button" class="page-header btn btn-primary"><i class="fa fa-truck"></i> Add Vehicle</a>
        <a href="{{url('estimates')}}" type="button" class="page-header btn btn-primary">All Estimates</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Estimate Data Form
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    
                    @if($errors->any())
                    <div class="form-group">
                        <div class="col-sm-12 alert alert-danger">
                            <ul id="estimate-form-errors">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>                            
                        </div>
                    </div>
                    @endif

                    <div class="form-group" >
                        <div class="col-sm-12" id="estimate-form-errors">

                        </div>
                    </div>
                    
                    {!! Form::open(array('url' => url('estimates'), 'class'=>'form-horizontal', 'id' => 'estimate-create-form')) !!}
                    <div class="row">
                        <div class="col-lg-7">
                        <div class="form-group">
                            {!! Form::label('customer', 'Customer', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::select('customer_id', ['' => 'Select a customer'] + $customer_list ,null , array('class' => 'form-control customer-select', 'id' => 'customer', 'required')) !!}
                            </div>
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('vehicle', 'Vehicle', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::select('vehicle_id', ['' => 'Select a vehicle'], null , array('class' => 'form-control', 'id' => 'vehicle')) !!}
                            </div>

                            {!! Form::label('mileage_in', 'Mileage In', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::text('mileage_in', null, ['class' => 'form-control', 'placeholder' => 'Mileage In', 'required']) !!}
                            </div>
                        </div>
                            
                        <div class="form-group">
                            {!! Form::label('department', 'Department', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                            {!! Form::select('department', ['' => 'Select a department'] + $departments, null, array('class' => 'form-control', 'id' => 'department', 'required')) !!}
                            </div>

                            {!! Form::label('estimate_type', 'Est Type', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::select('estimate_type', ['' => 'Select a type'] + $estimate_types, null, array('class' => 'form-control', 'id' => 'estimate-type', 'required')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('insurance', 'Insurance', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('insurance_company', ['' => 'Select a insurance company'] + $insurance_company, null, array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('sales_rep', 'Sales Rep', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('sales_rep', ['' => 'Select a sales rep'] + $sales_reps, null, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        </div>

                        
                        <div class="col-lg-5">
                            <h4 class="text-center">Quick add vehicle</h4>
                        <div class="form-group">                            
                            {!! Form::label('reg_no', 'Registration No', ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                            {!! Form::text('reg_no', null, ['class' => 'form-control', 'placeholder' => 'ex: CCA-XXXX', 'id' => 'vehicle-reg']) !!}
                            </div>
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('make', 'Make', ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                            {!! Form::text('make', null, ['class' => 'form-control', 'placeholder' => 'ex: TOYOTA']) !!}
                            </div>
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('model', 'Model', ['class' => 'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                            {!! Form::text('model', null, ['class' => 'form-control', 'placeholder' => 'ex: CROWN']) !!}
                            </div>
                        </div>
                        </div>
                        </div>                    
                    
                        <div class="row add-estimate-item-section">
                            <div class="col-lg-12" id="estmate-items-wrapper">
                                <table class="table table-bordered" id="dynamic-tbl">
                                    <thead>
                                            <th class="item-select">Item</th>
                                            <th class="item-desc">Description</th>
                                            <th class="item-qty">Qty</th>
                                            <th class="item-rate">Rate</th>
                                            <th class="item-amount">Amount</th>
                                            <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {!! Form::select('item_id[]', ['' => 'Select an item'] + $items, null, ['class' => 'form-control itemId itemIdFirst', 'id' => 'item_id', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('item_description[]', null, ['class' => 'form-control item_description', 'id' => 'item_description', 'placeholder' => 'Not Required | Optional', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('units[]', null, ['class' => 'form-control units', 'placeholder' => 'Add Number', 'id' => 'units', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('rate[]', null, ['class' => 'form-control rate', 'placeholder' => 'Add Rate', 'id' => 'rate', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('amount[]', null, ['class' => 'form-control amount', 'id' => 'amount', 'placeholder' => 'Add Hrs and Rate', 'required']) !!}
                                            </td>
                                            <td class="text-center actions"><a id="delete-row" href="#"><i class="fa fa-times"></i></a></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1">
                                <button class="btn btn-primary" type="button" class="addRow" id="addEstimateRow">add row</button>
                            </div>
                            <div class="col-lg-4">
                                {!! Form::submit('Save Estimate', ['class' => 'btn btn-success']) !!}
                                <button class="btn btn-default" type="button" onclick="calcTotal($('#dynamic-tbl'));" class="addRow">Calculate Total</button>
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
                                
                            </div>
                        </div>
                    
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addVehicleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(array('url' => url('vehicles'), 'class'=>'form-horizontal')) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Vehicle</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('customer', 'Customer', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('customer_id', ['' => 'Select a customer'] + $customer_list ,null , array('class' => 'form-control', 'id' => 'customer')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('reg_no', 'Registration No', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('reg_no', null, ['class' => 'form-control', 'required', 'placeholder' => 'ex: CAA-XXXX']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('make', 'Make', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('make', null, ['class' => 'form-control', 'placeholder' => 'ex: TOYOTA']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('model', 'Model', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('model', null, ['class' => 'form-control', 'placeholder' => 'ex: CROWN']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('year', 'Year', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('year', null, ['class' => 'form-control', 'placeholder' => 'ex: 2015']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('chasis_no', 'Chasis No', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('chasis_no', null, ['class' => 'form-control', 'placeholder' => 'Chasis No']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('next_service', 'Next Service', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('next_service', null, ['class' => 'form-control', 'placeholder' => 'ex: 20000']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Save Vehicle', ['class' => 'btn btn-primary']) !!}

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
	
	<div class="modal fade" id="addCustomerModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(array('url' => url('quick-add-customers'), 'class'=>'form-horizontal', 'id' => 'quick-add-customers')) !!}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Customer</h4>
                    <div id="submit-alert-customer">

                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('name', 'Customer Name', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'customer-name']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('address1', 'Address', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('address1', null, ['class' => 'form-control', 'placeholder' => 'Address', 'id' => 'customer-address']) !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        {!! Form::label('telephone', 'Telephone', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => 'Telephone']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('mobile', 'Mobile', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Mobile']) !!}
                        </div>
                    </div>
                </div>

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Vehicle</h4>
                    <div id="submit-alert-vehicle">

                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('reg_no', 'Registration No', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                        {!! Form::text('reg_no', null, ['class' => 'form-control', 'placeholder' => 'ex: CCA-XXXX', 'id' => 'quick-vehicle-reg']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('make', 'Make', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('make', null, ['class' => 'form-control', 'placeholder' => 'ex: TOYOTA', 'id' => 'quick-vehicle-make']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('model', 'Model', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('model', null, ['class' => 'form-control', 'placeholder' => 'ex: CROWN', 'id' => 'quick-vehicle-model']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Save Customer and Vehicle', ['class' => 'btn btn-primary']) !!}

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="addItemModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content" id="quick-add-item-model-content">
                {!! Form::open(array('url' => url(''), 'class'=>'form-horizontal', 'id' => 'quick-add-item')) !!}
                <div id="quick-add-item">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Item</h4>
                    <div id="submit-alert-item">

                    </div>
                </div>
                <div class="modal-body" id="quick-add-item-model-body">
                    <div class="form-group">
                        {!! Form::label('item-name', 'Item Name', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Item name is the default item description in estimates', 'id' => 'quick-add-item-name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('item-type', 'Type', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('type', ['' => 'Select an option', 'service' => 'Service Item', 'part' => 'Spare Part'], null, ['class' => 'form-control', 'id' => 'quick-add-item-type']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('sale-price', 'Sale Price (Rate)', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('sale_price', null, ['class' => 'form-control', 'placeholder' => 'Sale price is the rate use in estimates', 'id' => 'quick-add-item-price']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            {!! Form::checkbox('vat',1,false) !!}
                            {!! Form::label('vat-inc', 'VAT Include', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-sm-4">
                            {!! Form::checkbox('nbt',1,false) !!}
                            {!! Form::label('nbt-inc', 'NBT Include', ['class' => 'control-label']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="save-quick-item">Save Item</button>
                </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



@endsection