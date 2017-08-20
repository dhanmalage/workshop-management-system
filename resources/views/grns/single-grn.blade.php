@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">GRN #{{$grn->id}}</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('grn')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-refresh fa-fw"></i> All GRNs</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Supplier Details:</strong></div>
                <div class="panel-body">
                    <p><strong>Name: </strong>{{$supplier->name}}</p>
                    <p><strong>Address: </strong>{{$supplier->address1}},{{$supplier->address2}},{{$supplier->city}}</p>
                    <p><strong>Tel: </strong>{{$supplier->telephone}} <strong>Mobile: </strong>{{$supplier->mobile}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>GRN Details:</strong></div>
                <div class="panel-body">
                    <p><strong>GRN No: </strong>#{{$grn->id}}</p>
                    <p><strong>Date: </strong>{{$grn->created_at}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    GRN Items Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Description</th>
                                <th>Quantity Requested</th>
                                <th>Quantity In</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($grn_details as $detail)
                                <tr class="odd gradeX">
                                    <td>{{$detail->order_id}}</td>
                                    <td>{{$detail->item_description}}</td>
                                    <td>{{$detail->quantity}}</td>
                                    <td>{{$detail->quantity_in}}</td>
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