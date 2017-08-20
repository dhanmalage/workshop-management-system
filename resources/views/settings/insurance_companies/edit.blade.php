@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Add New Insurance Company</h3>
        </div>
        <div class="col-lg-8">
            <a href="{{url('insurance_companies')}}" type="button" class="page-header btn btn-primary">All Insurance Companies</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Insurance Company Data Form
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

                        {!! Form::model($insurance_company, ['action' => ['InsuranceCompaniesController@update', $insurance_company->id], 'role' => 'form', 'method' => 'PATCH', 'class'=>'form-horizontal']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Company Name', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Insurance Company Name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', 'Address', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Insurance Company Address']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('tel', 'Telephone', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => '#']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('fax', 'Fax', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('fax', null, ['class' => 'form-control', 'placeholder' => '#']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('vat-no', 'VAT No', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('vat_no', null, ['class' => 'form-control', 'placeholder' => 'Vat No']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('web', 'Website', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Website']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('c-person', 'Contact Person', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('contact_person', null, ['class' => 'form-control', 'placeholder' => 'Contact Person']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            {!! Form::submit('Save Company', ['class' => 'btn btn-primary']) !!}
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