@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Job Consumption Details</h3>
        </div>
        <div class="col-lg-8">

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Customer Details:</strong></div>
                <div class="panel-body">
                    <p><a href="{{url('estimates/'.$estimate->id)}}"><strong>Estimate #: </strong>{{$estimate->id}}</a></p>
                    <p><a href="{{url('jobs/'.$job->id)}}"><strong>Job #: </strong>{{$job->id}}</a></p>
                    <p><a href="{{url('customers/'.$customer->id)}}"><strong>Customer Name: </strong>{{$customer->name}}</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Vehicle Details:</strong></div>
                <div class="panel-body">
                    <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
                    <p><strong>Make: </strong>{{$vehicle->make}}</p>
                    <p><strong>Model: </strong>{{$vehicle->model}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Consumption Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($consumption_details as $detail)
                                <tr class="odd gradeX">
                                    <td>{{ $i }}</td>
                                    <td>{{$detail->description}}</td>
                                    <td>{{$detail->amount}}</td>
                                    <td>{{$detail->created_at}}</td>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info">
                <span class="alert-link">Total Amount: </span>
                {{$total}}
            </div>
        </div>
    </div>

@endsection