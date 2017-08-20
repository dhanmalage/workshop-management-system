@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">All Insurance Companies</h3>
        </div>
        <div class="col-lg-8">
            <a href="{{url('insurance_companies/create')}}" type="button" class="page-header btn btn-primary">Add New Company</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Insurance Company Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>VAT #</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insurance_companies as $company)
                                <tr class="odd gradeX">
                                    <td>{{$company->id}}</td>
                                    <td>{{$company->name}}</td>
                                    <td>{{$company->address}}</td>
                                    <td>{{$company->telephone}}</td>
                                    <td>{{$company->email}}</td>
                                    <td>{{$company->vat_no}}</td>
                                    <td class="text-center actions">
                                        <a href="{{url('insurance_companies/'.$company->id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                        <a href="{{url('insurance_companies/'.$company->id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection