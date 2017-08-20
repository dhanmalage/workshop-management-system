@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Issue Notes</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('issue_notes/create')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-check-square-o fa-fw"></i> New Issue Note</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Issue Notes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                            <tr>
                                <th>Issue Note #</th>
                                <th>Date</th>
                                <th>Remarks</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($issue_notes as $note)
                                <tr class="odd gradeX">
                                    <td class="text-center">{{$note->id}}</td>
                                    <td>{{$note->created_at}}</td>
                                    <td>{{$note->remark}}</td>
                                    <td class="text-center actions">
                                        <a href="{{url('issue_notes/'.$note->id)}}" title="View"><i class="fa fa-newspaper-o"></i></a>
                                    </td>
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