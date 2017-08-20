@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">KENTARO Admin System Reports</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="lead">Estimate</div>
                            <div>No of vehicles</div>
                        </div>
                    </div>
                </div>
                <a href="{{url('reports.est-vehicles')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Report</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="lead">Estimate</div>
                            <div>Pending Approval</div>
                        </div>
                    </div>
                </div>
                <a href="{{url('reports.est-pending')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Report</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="lead">Jobs</div>
                            <div>Open Jobs</div>
                        </div>
                    </div>
                </div>
                <a href="{{url('reports.jobs-open')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Report</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="lead">Jobs</div>
                            <div>Completed Jobs</div>
                        </div>
                    </div>
                </div>
                <a href="{{url('reports.jobs-complete')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Report</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="lead">Invoice</div>
                            <div>Job Invoices</div>
                        </div>
                    </div>
                </div>
                <a href="{{url('reports.job-invoices')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Report</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="lead">Invoice</div>
                            <div>Direct Invoices</div>
                        </div>
                    </div>
                </div>
                <a href="{{url('reports.direct-invoices')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Report</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection