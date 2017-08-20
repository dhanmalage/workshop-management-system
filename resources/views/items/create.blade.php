@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Add New Items</h3>
        </div>
        <div class="col-lg-9">
        <a href="{{url('items')}}" type="button" class="page-header btn btn-primary">All Items</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Item Data Form
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    
                    @if($errors->any())
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 alert alert-danger">                            
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>                            
                        </div>
                    </div>
                    @endif
                    
                    {!! Form::open(array('url' => url('items'), 'class' => 'form-horizontal', 'id' => 'item-form')) !!}
                    
                    <div class="form-group">
                        {!! Form::label('item-name', 'Item Name', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Item name is the default item description in estimates', 'required']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('item-type', 'Type', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                        {!! Form::select('type', ['' => 'Select an option', 'service' => 'Service Item', 'part' => 'Spare Part'], null, ['class' => 'form-control']); !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('item-cat', 'Category', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                        {!! Form::select('category_id', $catagories ,null , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('location', 'Location', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                        {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location']) !!} 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('item-unit', 'Unit of Sale', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                        {!! Form::select('unit_of_sale', ['' => 'Select an option', 'kg' => 'kg', 'units' => 'Units', 'litre' => 'Litre', 'panel' => 'Panel'], null, ['class' => 'form-control']); !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('sale-price', 'Sale Price (Rate)', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                        {!! Form::text('sale_price', null, ['class' => 'form-control', 'placeholder' => 'Sale price is the rate use in estimates', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <input type="hidden" name="vat" value="0">
                            {!! Form::checkbox('vat',1,false) !!}
                            {!! Form::label('vat-inc', 'VAT Include', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-sm-4">
                            <input type="hidden" name="nbt" value="0">
                            {!! Form::checkbox('nbt',1,false) !!}
                            {!! Form::label('nbt-inc', 'NBT Include', ['class' => 'control-label']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('po-level', 'Re-order Level', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                        {!! Form::text('pre_order_level', null, ['class' => 'form-control', 'placeholder' => 'Re-order Level']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                        {!! Form::submit('Save Item', ['class' => 'btn btn-primary']) !!} 
                        {!! Form::reset('Reset Form', ['class' => 'btn btn-default']) !!} 
                        </div>
                    </div>
                    
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            
        </div>
    </div>


@endsection