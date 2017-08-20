@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Create Job</h3>
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-9">
            <a href="{{url('jobs')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-briefcase fa-fw"></i> All Jobs</a>
        </div>
        <!-- /.col-lg-3 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Customer Details:</strong></div>
                <div class="panel-body">
                    <div class="col-sm-3"><p><strong>Name: </strong></p></div><div class="col-sm-9"><p>{{$customer->name}}</p></div>
                    <div class="col-sm-3"><p><strong>Address: </strong></p></div><div class="col-sm-9"><p>{{$customer->address1}},{{$customer->address2}},{{$customer->city}}</p></div>
                    <div class="col-sm-3"><p><strong>Tel: </strong></p></div><div class="col-sm-9"><p>{{$customer->telephone}} @if($customer->mobile != null), {{$customer->mobile}}@endif</p></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Vehicle Details:</strong></div>
                <div class="panel-body">
                    <div class="col-sm-4"><p><strong>Registration No: </strong></p></div><div class="col-sm-8"><p>{{$vehicle->reg_no}}</p></div>
                    <div class="col-sm-4"><p><strong>Make: </strong></p></div><div class="col-sm-8"><p>{{$vehicle->make}}</p></div>
                    <div class="col-sm-4"><p><strong>Model: </strong></p></div><div class="col-sm-8"><p>{{$vehicle->model}}</p></div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(array('url' => url('jobs'), 'class'=>'form-horizontal')) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('remarks', 'Remarks', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8 date">
                            {!! Form::textarea('remark', null, ['class' => 'form-control', 'placeholder' => 'Remarks']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('service-advisor', 'Service Advisor', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                        {!! Form::select('advisor', ['' => 'Select an Advisor'] + $employees ,null , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('section-incharge', 'Secton Incharge', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('section-incharge', ['' => 'Select an Incharge'] + $employees ,null , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('promised-dare', 'Promised Date', ['class' => 'col-sm-4 control-label']) !!}
                        <div class="col-sm-8 date">
                            {!! Form::text('promised_date', null, ['class' => 'form-control', 'placeholder' => 'Promised Date', 'id' => 'promised-date']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {!! Form::hidden('estimate_id', $estimate->id, ['class' => 'form-control']) !!}
                            {!! Form::submit('Create Job', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}


@endsection