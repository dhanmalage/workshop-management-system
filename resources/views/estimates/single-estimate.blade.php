@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Estimate Details</h3>
        </div>
        <div class="col-lg-9">
            @if($estimate->job_id != null)
                <a href="{{url('jobs/'.$estimate->job_id)}}" type="button" class="page-header btn btn-primary"><i class="fa fa-briefcase fa-fw"></i> View Job</a>
            @else
                <a href="{{url('jobs/create_job/'.$estimate->id)}}" type="button" class="page-header btn btn-primary"><i class="fa fa-briefcase fa-fw"></i> Create Job</a>
                <a href="{{url('estimates/'.$estimate->id.'/edit')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
            @endif
            @if($job != null)
                @if($job->status == 'open')
                    <a href="{{url('supplementary_estimates/create_supplementary/'.$estimate->id)}}" type="button" class="page-header btn btn-primary"><i class="fa fa-plus-square-o"></i> Supplementary</a>
                @endif
            @endif
            <a href="{{url('estimates')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-file-text-o"></i> All Estimates</a>
            <a href="{{url('download_estimate/'.$estimate->id)}}"  type="button" class="page-header btn btn-primary"><i class="fa fa-file-pdf-o"></i> </a>
            <a href="{{url('print_estimate/'.$estimate->id)}}" target="_blank" type="button" class="page-header btn btn-primary"><i class="fa fa-print"></i> Print</a>
            <a href="{{url('download_estimate_insurance/'.$estimate->id)}}" target="_blank" type="button" class="page-header btn btn-primary"><i class="fa fa-info" aria-hidden="true"></i> Insurance</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

<div class="row">
    <div class="col-md-6">
        <div class="alert alert-info">
            <span class="alert-link uppercase">Department: </span>{{$department->name}} &nbsp;&nbsp;&nbsp; <span class="alert-link"> Type: </span>{{$est_type->estimate_type}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="alert alert-info">
            <span class="alert-link uppercase">Estimate Date: </span>{{$estimate->created_at}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading"><strong>Customer Details:</strong></div>
            <div class="panel-body uppercase">
                <p><strong>Name: </strong>{{$customer->name}}</p>
                <p><strong>Address: </strong>{{$customer->address1}}, {{$customer->address2}}, {{$customer->city}}</p>
                <p><strong>Tel: </strong>{{$customer->telephone}} <strong>Mobile: </strong>{{$customer->mobile}}</p>
                <p><strong>Fax: </strong>{{$customer->fax}}</p>
                @if(isset($insurance_company))
                    @if($insurance_company->name == 'Personal')
                        <p><strong>Estimate Type: </strong>
                            {{$insurance_company->name}}
                        </p>
                    @endif
                @endif
            </div>
        </div>
        @if(isset($insurance_company))
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Insurance Details:</strong></div>
                <div class="panel-body uppercase">
                    <p><strong>Name: </strong>
                        {{$insurance_company->name}}
                    </p>
                    <p><strong>Address: </strong>
                        {{$insurance_company->address}}
                    </p>
                    <p><strong>VAT No: </strong>
                        {{$insurance_company->vat_no}}
                    </p>
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading"><strong>Vehicle Details:</strong></div>
            <div class="panel-body uppercase">
                <p><strong>Registration No: </strong>{{$vehicle->reg_no}}</p>
                <p><strong>Make: </strong>{{$vehicle->make}}</p>
                <p><strong>Model: </strong>{{$vehicle->model}}</p>
                <p><strong>Chasis No: </strong>{{$vehicle->chasis_no}}</p>
                <p><strong>Mileage In: </strong>{{$estimate->mileage_in}}</p>
                @if(isset($insurance_company))
                    @if($insurance_company->name == 'Personal')
                        <p><strong>Estimate Type: </strong>
                            {{$insurance_company->name}}
                        </p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Estimate Data
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body estimate-services-section">
                <div class="dataTable_wrapper">
                    <h4>Services</h4>
                    <table class="table table-striped table-bordered table-hover uppercase" id="dataTables-function">
                        <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Approved Amount</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $i = 1; ?>
                        @foreach($estimate_details as $detail)
                            @if($detail->type == "service")
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td class="uppercase">{{$detail->item_description}}</td>
                                <td>{{$detail->units}}</td>
                                <td>{{$detail->rate}}</td>
                                <td>{{$detail->initial_amount}}</td>
                                <td>{{$detail->approved_amount}}</td>
                            </tr>
                            <?php $i++ ?>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="panel-body estimate-parts-section">
                <div class="dataTable_wrapper">
                    <h4>Spare Parts</h4>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-function1">
                        <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Approved Amount</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $i = 1; ?>
                        @foreach($estimate_details as $detail)
                            @if($detail->type == "part")
                                <tr class="odd gradeX">
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td class="uppercase">{{$detail->item_description}}</td>
                                    <td>{{$detail->units}}</td>
                                    <td>{{$detail->rate}}</td>
                                    <td>{{$detail->initial_amount}}</td>
                                    <td>{{$detail->approved_amount}}</td>
                                </tr>
                                <?php $i++ ?>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="alert alert-info">
            <span class="alert-link">Total: </span>Rs. {{$estimate->net_amount}}
        </div>
    </div>
</div>


<?php $j = 1; ?>
@foreach($supplementary_estimates as $supplementary_estimate)

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Supplementary Estimate Data
                    <a href="{{url('download_supplementary/'.$supplementary_estimate->id)}}"  type="button" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                    <a href="{{url('print_supplementary/'.$supplementary_estimate->id)}}" target="_blank" type="button" class="btn btn-primary"><i class="fa fa-print"></i></a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover uppercase" id="dataTables-function<?php echo $j; ?>">
                        <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Description</th>
                            <th>Units</th>
                            <th>Rate</th>
                            <th class="text-center">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($supplementary_estimate_details as $supplementary_estimate_detail)
                        @if($supplementary_estimate->id == $supplementary_estimate_detail->supplementary_estimate_id)
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>{{$supplementary_estimate_detail->item_description}}</td>
                                <td>{{$supplementary_estimate_detail->units}}</td>
                                <td>{{$supplementary_estimate_detail->rate}}</td>
                                <td>{{$supplementary_estimate_detail->initial_amount}}</td>
                            </tr>
                        @endif
                        <?php $i++ ?>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="alert alert-info">
            <span class="alert-link">Total: </span>Rs. {{$supplementary_estimate->net_amount}}
        </div>
    </div>
</div>
<?php $j++ ?>
@endforeach


<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info">
            <span class="alert-link">Grand Total: </span>Rs.
            @if($job != null)
                {{$job->grand_total}}
            @else
                {{$estimate->net_amount}}
            @endif
        </div>
    </div>
</div>

@endsection