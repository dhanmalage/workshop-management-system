@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-2">
            <h3 class="page-header">Job Details</h3>
        </div>
        <div class="col-lg-7">
            <a href="{{url('download_job/'.$job->id)}}"  type="button" class="page-header btn btn-primary"><i class="fa fa-file-pdf-o"></i></a>
            <a href="{{url('print_job/'.$job->id)}}" target="_blank" type="button" class="page-header btn btn-primary"><i class="fa fa-print"></i></a>
            @if($job->status == 'open')
            <a href="{{url('jobs/job_done/'.$job->id)}}" type="button" class="page-header btn btn-warning"><i class="fa fa-check"></i> Job Done</a>
            @endif
            @if($job->status == 'job_done')
                <a href="{{url('invoices/new_job_invoice/'.$job->id)}}" type="button" class="page-header btn btn-success"><i class="fa fa-file-text-o" aria-hidden="true"></i> Create Invoice</a>
            @endif
            @if($job->labour_status == 'open')
                <a href="{{url('jobs/labour_complete/'.$job->id)}}" type="button" class="page-header btn btn-info"><i class="fa fa-clock-o"></i> Finish Labour</a>
            @endif
            @if($job->consumptions_status == 'open')
                <a href="{{url('jobs/consumption_complete/'.$job->id)}}" type="button" class="page-header btn btn-info"><i class="fa fa-folder-open"></i> Finish Consumption</a>
            @endif
        </div>
        <div class="col-lg-3">
            @if($job->status == 'open')
                <div class="page-header alert alert-warning">
                    <strong><i class="fa fa-exclamation"></i> Job Open !</strong>
                </div>
            @elseif($job->status == 'complete')
                <div class="page-header alert alert-success">
                    <strong><i class="fa fa-check"></i> Job Complete !</strong>
                </div>
            @elseif($job->status == 'job_done')
                <div class="page-header alert alert-info">
                    <strong><i class="fa fa-check"></i> Job Done!</strong>
                </div>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-body uppercase">
                    <p><strong>Department: </strong>{{$department->name}}</p>
                    <p><strong>Service Advisor: </strong>{{$s_advisor->name}}</p>
                    <p><strong>Customer Details:</strong></p>
                    <p><strong>Name: </strong>{{$customer->name}}</p>
                    <p><strong>Address: </strong>{{$customer->address1}}, {{$customer->address2}}, {{$customer->city}}</p>
                    <p><strong>Tel: </strong>{{$customer->telephone}} <strong>Mobile: </strong>{{$customer->mobile}}</p>
                    <p><strong>Fax: </strong>{{$customer->fax}}</p>
                    <p><strong>Insurance Company: </strong>
                        @if(isset($insurance_company))
                            {{$insurance_company->name}}
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-body uppercase">
                    <p><strong>JOB No: </strong>JOB # {{$job->id}} &nbsp;&nbsp;&nbsp; <strong>Date: </strong>{{$job->created_at->format('Y-m-d')}}</p>
                    <p><strong>Promised Date: </strong>{{$job->promised_date}}</p>
                    <p><strong>Vehicle Details:</strong></p>
                    <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
                    <p><strong>Make: </strong>{{$vehicle->make}}</p>
                    <p><strong>Model: </strong>{{$vehicle->model}}</p>
                    <p><strong>Chasis No: </strong>{{$vehicle->chasis_no}}</p>
                    <p><strong>Mileage In: </strong>{{$estimate->mileage_in}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Job Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover uppercase" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Issued</th>
                                <th>Balance</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($job_details as $detail)
                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td class="uppercase">{{$detail->item_description}}</td>
                                    <td>{{$detail->units}}</td>
                                    <td>{{$detail->quantity_issued}}</td>
                                    <td>{{$detail->balance_quantity}}</td>
                                    <td>
                                        @if($detail->task_status != 'open')
                                            <span class="status-label label label-success">Complete</span>
                                        @else
                                            <span class="status-label label label-warning">Open</span>
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection