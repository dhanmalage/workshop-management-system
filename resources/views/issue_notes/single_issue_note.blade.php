@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Issue Note #{{$issue_note->id}}</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('issue_notes')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-file-text-o"></i> All Issue Notes</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><strong>Remarks:</strong></div>
                <div class="panel-body">
                    <p>{{$issue_note->remark}}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Issue Note Items Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>Job #</th>
                                <th>Item</th>
                                <th>quantity_requested</th>
                                <th>quantity_issued</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($issue_note_details as $detail)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('jobs/'.$detail->job_id)}}">{{$detail->job_id}}</a></td>
                                    <td>{{$detail->item_description}}</td>
                                    <td>{{$detail->quantity_requested}}</td>
                                    <td>{{$detail->quantity_issued}}</td>
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