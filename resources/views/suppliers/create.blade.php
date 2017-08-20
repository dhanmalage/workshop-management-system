@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Add New Supplier</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('suppliers')}}" type="button" class="page-header btn btn-primary">All Suppliers</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Supplier Data Form
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                @if($errors->any())
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8 alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {!! Form::open(array('url' => url('suppliers'), 'class'=>'form-horizontal')) !!}
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Supplier Name', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address1', 'Address Line 1', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('address1', null, ['class' => 'form-control', 'placeholder' => 'Address Line 1']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address2', 'Address Line 2', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('address2', null, ['class' => 'form-control', 'placeholder' => 'Address Line 2']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('city', 'City', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('telephone', 'Telephone', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => 'Telephone']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('mobile', 'Mobile', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Mobile']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                        {!! Form::label('fax', 'Fax No', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('fax', null, ['class' => 'form-control', 'placeholder' => 'Fax No']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('website', 'Website', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Website']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('vat_no', 'Vat No', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('vat_no', null, ['class' => 'form-control', 'placeholder' => 'Vat No']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('contact_person', 'Contact Person', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('contact_person', null, ['class' => 'form-control', 'placeholder' => 'Contact Person']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('account_sys_id', 'Account System ID', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('account_sys_id', null, ['class' => 'form-control', 'placeholder' => 'Account System ID']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            {!! Form::submit('Save Supplier', ['class' => 'btn btn-primary']) !!}
                            {!! Form::reset('Reset Form', ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
