@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">GRN</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('grn/create')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-refresh fa-fw"></i> New GRN</a>
            <a href="{{url('orders/create')}}" type="button" class="page-header btn btn-primary">New Purchase Order</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All GRN Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>GRN #</th>
                                <th>Supplier</th>
                                <th>GRN Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($grns as $grn)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('grn/'.$grn->grn_id)}}" title="View">{{$grn->grn_id}}</a></td>
                                    <td>{{$grn->sname}}</td>
                                    <td>{{$grn->date}}</td>
                                    <td class="text-center actions">
                                        <a href="{{url('grn/'.$grn->grn_id)}}" title="View"><i class="fa fa-newspaper-o"></i></a>
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