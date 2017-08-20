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

                    {!! Form::open(array('url' => url('grn'), 'class'=>'form-horizontal')) !!}
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group">
                                {!! Form::label('supplier', 'Supplier', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10" id="grn-supplier">
                                    {!! Form::select('supplier_id', ['' => 'Select a supplier'] + $suppliers, null, array('class' => 'form-control', 'id' => 'supplier', 'required')) !!}
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-5">

                        </div>
                    </div>

                    <div class="row add-estimate-item-section">
                        <div class="col-lg-12" id="estmate-items-wrapper">
                            <table class="table table-bordered grn-create" id="dynamic-tbl">
                                <thead>
                                <th>Order #</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Quantity Requested</th>
                                <th>Quantity In</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            {!! Form::submit('Save GRN', ['class' => 'btn btn-success save-grn']) !!}
                        </div>
                        <div class="col-lg-3">

                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection