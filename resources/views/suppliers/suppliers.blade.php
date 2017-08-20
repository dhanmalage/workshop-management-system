@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-2">
            <h3 class="page-header">Suppliers</h3>
        </div>
        <div class="col-lg-10">
            <a href="{{url('suppliers/create')}}" type="button" class="page-header btn btn-primary">New Suppliers</a>
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Telephone</th>
                                <th>Mobile</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($suppliers as $supplier)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('suppliers/'.$supplier->id)}}" title="View">{{$supplier->id}}</a></td>
                                    <td><a href="{{url('suppliers/'.$supplier->id)}}" title="View">{{$supplier->name}}</a></td>
                                    <td><a href="{{url('suppliers/'.$supplier->id)}}" title="View">{{$supplier->address1}},&nbsp;{{$supplier->address2}},&nbsp;{{$supplier->city}}</a></td>
                                    <td><a href="{{url('suppliers/'.$supplier->id)}}" title="View">{{$supplier->telephone}}</a></td>
                                    <td><a href="{{url('suppliers/'.$supplier->id)}}" title="View">{{$supplier->mobile}}</a></td>
                                    <td class="text-center actions">
                                        <a href="{{url('suppliers/'.$supplier->id)}}" title="View"><i class="fa fa-male"></i></a>
                                        <a href="{{url('suppliers/'.$supplier->id.'/edit')}}" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
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