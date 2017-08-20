@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Estimate No of Vehicles</h3>
        </div>
        <div class="col-lg-8">
            {!! Form::open(array('url' => url('reports.est-vehicles'), 'id'=>'report-dates', 'class'=>'form-inline page-header-form')) !!}
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
                    Estimate No of Vehicles
                    @if(isset($new_date1_format) && isset($new_date2_format))
                        (<strong>From </strong>{{$new_date1_format}} <strong>To </strong>{{$new_date2_format}})
                        <a href="{{url('reports.download_est-vehicles/'.$new_date1_format.'/'.$new_date2_format)}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF Export</a>
                    @else
                        <a href="{{url('reports.download_est-vehicles/')}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> PDF Export</a>
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Reg #</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Year</th>
                                <th>Customer</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($vehicles as $vehicle)
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td>{{$vehicle->reg_no}}</td>
                                    <td>{{$vehicle->make}}</td>
                                    <td>{{$vehicle->model}}</td>
                                    <td>{{$vehicle->year}}</td>
                                    <td><a href="{{url('customers/'.$vehicle->customer_id)}}">{{$vehicle->customer_name}}</a></td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection