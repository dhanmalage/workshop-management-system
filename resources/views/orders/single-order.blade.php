@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Purchase Order #{{$order->id}}</h3>
        </div>
        <div class="col-lg-9">
            <a href="" type="button" class="page-header btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit Order</a>
            <a href="{{url('orders')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-file-text-o"></i> All Orders</a>
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
                    <p><strong>Fax: </strong>{{$supplier->fax}}</p>
                    <p><strong>Email: </strong>{{$supplier->email}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Order Details:</strong></div>
                <div class="panel-body">
                    <p><strong>Order No: </strong>#{{$order->id}}</p>
                    <p><strong>Date: </strong>{{$created_at}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Order Items Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($order_details as $detail)
                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>{{$detail->item_description}}</td>
                                    <td>{{$detail->quantity}}</td>
                                    <td>{{$detail->price}}</td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="alert alert-info">
                <span class="alert-link">Total: </span>{{$order->total}}
            </div>
        </div>
    </div>

@endsection