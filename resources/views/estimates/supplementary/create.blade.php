@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Add Supplementary Estimate</h3>
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
                    Supplementary Estimate Data Form
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
                    
                    {!! Form::open(array('url' => url('supplementary_estimates'), 'class'=>'form-horizontal')) !!}

                    {!! Form::hidden('estimate_id', $estimate->id, ['class' => 'form-control']) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="alert alert-info">
                                <span class="alert-link">Customer: </span>{{$customer->name}} <br><br>
                                <span class="alert-link">Vehicle: </span>{{$vehicle->reg_no}}
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="alert alert-info">
                                <span class="alert-link">Department: </span>{{$department->name}}
                            </div>
                        </div>
                        </div>                    
                    
                        <div class="row add-estimate-item-section">
                            <div class="col-lg-12" id="estmate-items-wrapper">
                                <table class="table table-bordered" id="dynamic-tbl">
                                    <thead>
                                            <th class="item-select">Item</th>
                                            <th class="item-desc">Description</th>
                                            <th class="item-qty">Number</th>
											<th class="item-rate">Rate</th>
											<th class="item-amount">Amount</th>
                                            <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                        <tr id="1">
                                            <td>
                                                {!! Form::select('item_id[]', ['' => 'Select an item'] + $items, null, ['class' => 'form-control itemId itemIdFirst', 'id' => 'item_id', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('item_description[]', null, ['class' => 'form-control item_description', 'id' => 'item_description', 'placeholder' => 'Not Required | Optional']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('units[]', null, ['class' => 'form-control', 'placeholder' => 'Add Number', 'id' => 'units', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('rate[]', null, ['class' => 'form-control', 'placeholder' => 'Add Rate', 'id' => 'rate', 'required']) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('amount[]', null, ['class' => 'form-control amount', 'id' => 'amount', 'placeholder' => 'Add Hrs and Rate']) !!}
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