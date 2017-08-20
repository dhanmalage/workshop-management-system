@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Estimate Details</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('jobs/create_job/'.$estimate->id)}}" type="button" class="page-header btn btn-primary"><i class="fa fa-briefcase fa-fw"></i> Create Job</a>
            <a href="{{url('estimates/'.$estimate->id.'/edit')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit Estimate</a>
            <a href="{{url('estimates')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-file-text-o"></i> All Estimates</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

<div class="row">
    <div class="col-md-6">
        <div class="alert alert-info">
            <span class="alert-link">Department: </span>{{$department->name}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="alert alert-info">
            <span class="alert-link">Estimate Date: </span>{{$estimate->created_at}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading"><strong>Customer Details:</strong></div>
            <div class="panel-body">
                <p><strong>Name: </strong>{{$customer->name}}</p>
                <p><strong>Address: </strong>{{$customer->address1}},{{$customer->address2}},{{$customer->city}}</p>
                <p><strong>Tel: </strong>{{$customer->telephone}} <strong>Mobile: </strong>{{$customer->mobile}}</p>
                <p><strong>Fax: </strong>{{$customer->fax}}</p>
                <p><strong>Email: </strong>{{$customer->email}}</p>
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
                Estimate Data
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover uppercase" id="dataTables-function">
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
                        @foreach($estimate_details as $detail)
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>{{$detail->item_description}}</td>
                                <td>{{$detail->units}}</td>
                                <td>{{$detail->rate}}</td>
                                <td>{{$detail->initial_amount}}</td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="alert alert-info">
            <span class="alert-link">Total: </span>{{$estimate->net_amount}}
        </div>
    </div>
</div>

@endsection