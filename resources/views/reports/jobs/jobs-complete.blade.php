@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Completed Jobs Report</h3>
        </div>
        <div class="col-lg-8">
            {!! Form::open(array('url' => url('reports.jobs-complete'), 'id'=>'report-dates', 'class'=>'form-inline page-header-form')) !!}
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
                    Completed Jobs Report
                    @if(isset($new_date1_format) && isset($new_date2_format))
                        (<strong>From </strong>{{$new_date1_format}} <strong>To </strong>{{$new_date2_format}})
                        <a href="{{url('reports.download_jobs-complete/'.$new_date1_format.'/'.$new_date2_format)}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF Export</a>
                    @else
                        <a href="{{url('reports.download_jobs-complete/')}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF Export</a>
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>Job #</th>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Promised Date</th>
                                <th>Grand Total</th>
                                <th>S.Advisor</th>
                                <th>Created at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr class="odd gradeX">
                                    <td>Job # {{$job->job_id}}</td>
                                    <td>{{$job->cname}}</td>
                                    <td>{{$job->reg_no}}</td>
                                    <td>{{$job->promised_date}}</td>
                                    <td>{{$job->grand_total}}</td>
                                    <td>{{$job->sname}}</td>
                                    <td>{{$job->job_date}}</td>
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