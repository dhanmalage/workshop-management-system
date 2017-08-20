@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Customer Details</h3>
        </div>
        <div class="col-lg-9">
            <a type="button" class="page-header btn btn-primary" data-toggle="modal" data-target="#addVehicleModel">Add Vehicle</a>
            <a href="{{url('customers')}}" type="button" class="page-header btn btn-primary">All Customers</a>
            <a href="{{url('customers/create')}}" type="button" class="page-header btn btn-primary">New Customer</a>
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
                    <h3 class="panel-title uppercase">{{$customer->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{url('images/avatar_640.png')}}" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td class="uppercase">{{$customer->name}}</td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td class="uppercase">{{$customer->address1}},{{$customer->address2}},{{$customer->city}}</td>
                                </tr>
                                <tr>
                                    <td>Contact person:</td>
                                    <td class="uppercase">{{$customer->contact_person}}</td>
                                </tr>
                                <tr><td>Phone Number</td>
                                    <td><abbr title="Telephone">Telephone:</abbr>{{$customer->telephone}}<br><br><abbr title="Mobile">Mobile:</abbr>{{$customer->mobile}}
                                    </td>
                                </tr>
                                <tr><td>Date of Birth</td>
                                    <td>{{$customer->dob}}</td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><a href="mailto:{{$customer->email}}">{{$customer->email}}</a></td>
                                </tr>

                                <tr>
                                </tr><tr>
                                    <td>Fax</td>
                                    <td>{{$customer->fax}}</td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td><a href="http://{{$customer->website}}" target="_blank">{{$customer->website}}</a></td>
                                </tr>
                                <tr>
                                    <td>Vat No</td>
                                    <td>{{$customer->vat_no}}</td>
                                </tr>
                                <tr>
                                    <td>Credit Limit</td>
                                    <td>Rs. {{$customer->credit_limit}}</td>
                                </tr>
                                <tr>
                                    <td>Account sys ID</td>
                                    <td>{{$customer->account_sys_id}}</td>
                                </tr>
                                <tr><td>How did you hear about us</td>
                                    <td>{{$customer->how}}</td>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="mailto:{{$customer->email}}" data-toggle="modal" data-target="#sendEmailModel" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                    <a href="mailto:{{$customer->email}}" data-toggle="modal" data-target="#addVehicleModel" type="button" class="btn btn-sm btn-primary">+ <i class="fa fa-truck"></i></a>
                        <span class="pull-right">
                            <a href="{{url('customers/'.$customer->id.'/edit')}}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                </div>

            </div>
            </div>
        <div class="col-lg-2">
        </div>
        </div>


    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Vehicles</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="Car Pic" src="{{url('images/car.png')}}" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-vehicle-information">
                                <tbody>
                                @foreach($vehicles as $vehicle)
                                <tr>
                                    <td>Reg #: <span class="uppercase">{{$vehicle->reg_no}}</span></td>
                                    <td>Make: <span class="uppercase">{{$vehicle->make}}</span></td>
                                    <td>Model: <span class="uppercase">{{$vehicle->model}}</span></td>
                                    <td><a href="{{url('vehicles/'.$vehicle->id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a></td>
                                </tr>
                                @endforeach
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


    <div class="modal fade" id="sendEmailModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(array('class'=>'form-horizontal')) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Email Message</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        {!! Form::label('email', 'Email Address', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::email('email', $customer->email, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('subject', 'Subject', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Add Subject']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('message', 'Email Message', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Email Message']) !!}
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Send Email', ['class' => 'btn btn-primary']) !!}

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="addVehicleModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(array('url' => url('vehicles'), 'class'=>'form-horizontal')) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Vehicle</h4>
                </div>
                <div class="modal-body">
                    {!! Form::hidden('customer_id', $customer->id, ['id' => 'invisible_id']) !!}
                    <div class="form-group">
                        {!! Form::label('reg_no', 'Registration No', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('reg_no', null, ['class' => 'form-control', 'required', 'placeholder' => 'ex: CAA-XXXX']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('make', 'Make', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('make', null, ['class' => 'form-control', 'placeholder' => 'ex: TOYOTA']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('model', 'Model', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('model', null, ['class' => 'form-control', 'placeholder' => 'ex: CROWN']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('year', 'Year', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('year', null, ['class' => 'form-control', 'placeholder' => 'ex: 2015']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('chasis_no', 'Chasis No', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('chasis_no', null, ['class' => 'form-control', 'placeholder' => 'Chasis No']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('next_service', 'Next Service', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('next_service', null, ['class' => 'form-control', 'placeholder' => 'ex: 20000']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Save Vehicle', ['class' => 'btn btn-primary']) !!}

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection