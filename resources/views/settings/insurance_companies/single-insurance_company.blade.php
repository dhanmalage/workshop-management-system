@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Customer Details</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('insurance_companies/create')}}" type="button" class="page-header btn btn-primary">Add New Company</a>
            <a href="{{url('insurance_companies')}}" type="button" class="page-header btn btn-primary">All Companies</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$insurance_company->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{url('images/company.png')}}" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td>{{$insurance_company->name}}</td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td>{{$insurance_company->address}}</td>
                                </tr>

                                <tr>
                                    <td>Telephone:</td>
                                    <td>{{$insurance_company->telephone}}</td>
                                </tr>

                                <tr>
                                    <td>VAT No:</td>
                                    <td>{{$insurance_company->vat_no}}</td>
                                </tr>

                                <tr>
                                    <td>Contact person:</td>
                                    <td>{{$insurance_company->contact_person}}</td>
                                </tr>

                                <tr>
                                    <td>Email:</td>
                                    <td><a href="mailto:{{$insurance_company->email}}">{{$insurance_company->email}}</a></td>
                                </tr>

                                <tr>
                                </tr><tr>
                                    <td>Fax:</td>
                                    <td>{{$insurance_company->fax}}</td>
                                </tr>
                                <tr>
                                    <td>Website:</td>
                                    <td><a href="http://{{$insurance_company->website}}" target="_blank">{{$insurance_company->website}}</a></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>

    </div>




@endsection