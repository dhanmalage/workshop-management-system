@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Purchase Orders</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('orders/create')}}" type="button" class="page-header btn btn-primary">New Order</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Supplier Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Supplier</th>
                                <th>Order Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr class="odd gradeX">
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->sname}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td class="text-center actions">
                                        <a href="{{url('orders/'.$order->id)}}" title="View"><i class="fa fa-newspaper-o"></i></a>
                                        <a href="{{url('orders/'.$order->id.'/edit')}}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
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