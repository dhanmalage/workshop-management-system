@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Pending Estimates</h3>
        </div>
        <div class="col-lg-8">
            {!! Form::open(array('url' => url('reports.est-pending'), 'id'=>'report-dates', 'class'=>'form-inline page-header-form')) !!}
                <div class="form-group">
                    {!! Form::label('from', 'From', ['class' => 'control-label']) !!}
                    {!! Form::text('date1', null, ['class' => 'form-control', 'id' => 'date-pick1', 'placeholder' => 'yyyy/mm/dd']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('to', 'To', ['class' => 'control-label']) !!}
                    {!! Form::text('date2', null, ['class' => 'form-control', 'id' => 'date-pick2', 'placeholder' => 'yyyy/mm/dd']) !!}
                </div>
                    {!! Form::submit('View Report', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            <div id="submit-alert" class="custom-alert-warning"></div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pending Estimates
                    @if(isset($new_date1_format) && isset($new_date2_format))
                       ( <strong>From </strong>{{$new_date1_format}} <strong>To </strong>{{$new_date2_format}} )
                        <a href="{{url('reports.download_est-pending/'.$new_date1_format.'/'.$new_date2_format)}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF Export</a>
                    @else
                        <a href="{{url('reports.download_est-pending/')}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF Export</a>
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Department</th>
                                <th>Net Total</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($estimates as $estimate)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('estimates/'.$estimate->est_id)}}">Est # {{$estimate->est_id}}</a></td>
                                    <td>
                                        <a href="{{url('customers/'.$estimate->customer_id)}}">{{$estimate->cname}}</a>
                                    </td>
                                    <td>{{$estimate->reg_no}}</td>
                                    <td>{{$estimate->dname}}</td>
                                    <td class="center">{{$estimate->net_amount}}</td>
                                    <td class="center">{{$estimate->est_date}}</td>
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