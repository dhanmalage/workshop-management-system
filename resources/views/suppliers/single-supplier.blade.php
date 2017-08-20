@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Supplier Details</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('suppliers')}}" type="button" class="page-header btn btn-primary">All Suppliers</a>
            <a href="{{url('suppliers/create')}}" type="button" class="page-header btn btn-primary">New Supplier</a>
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
                    <h3 class="panel-title">{{$supplier->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{url('images/avatar_640.png')}}" class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td>{{$supplier->name}}</td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td>{{$supplier->address1}},{{$supplier->address2}},{{$supplier->city}}</td>
                                </tr>
                                <tr>
                                    <td>Contact person:</td>
                                    <td>{{$supplier->contact_person}}</td>
                                </tr>
                                <tr><td>Phone Number</td>
                                    <td><abbr title="Telephone">Telephone:</abbr>{{$supplier->telephone}}<br><br><abbr title="Mobile">Mobile:</abbr>{{$supplier->mobile}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><a href="mailto:{{$supplier->email}}">{{$supplier->email}}</a></td>
                                </tr>

                                <tr>
                                </tr><tr>
                                    <td>Fax</td>
                                    <td>{{$supplier->fax}}</td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td><a href="http://{{$supplier->website}}" target="_blank">{{$supplier->website}}</a></td>
                                </tr>
                                <tr>
                                    <td>Vat No</td>
                                    <td>{{$supplier->vat_no}}</td>
                                </tr>
                                <tr>
                                    <td>Account sys ID</td>
                                    <td>{{$supplier->account_sys_id}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="mailto:{{$supplier->email}}" data-toggle="modal" data-target="#sendEmailModel" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="{{url('suppliers/'.$supplier->id.'/edit')}}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
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
                            {!! Form::email('email', $supplier->email, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
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

@endsection