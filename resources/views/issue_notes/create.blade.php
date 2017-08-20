@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Add New Issue Note</h3>
        </div>
        <div class="col-lg-8">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Issue Note Data Form
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    @if($errors->any())
                        <div class="form-group">
                            <div class="col-sm-12 alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {!! Form::open(array('url' => url('issue_notes'), 'class'=>'form-horizontal')) !!}

                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::textarea('remark', null, ['class' => 'form-control','rows' => '3', 'cols' => '50', 'placeholder' => 'Remarks', 'id' => 'remark']) !!}
                        </div>
                    </div>

                    <div class="row add-estimate-item-section">
                        <div class="col-lg-12" id="issue-note-wrapper">
                            <table class="table table-bordered" id="dynamic-tbl">
                                <thead>
                                <th>Job #</th>
                                <th>Item</th>
                                <th>Quantity Requested</th>
                                <th>Quantity Issued</th>
                                <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                <tr id="1">
                                    <td>
                                        <select name="job_id[]" class="form-control" id="job_id_1" required>
                                            <option>Select a Job</option>
                                            @foreach($jobs as $job)
                                                <option value="{{$job->id}}">{{$job->id}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="item[]" class="form-control" id="issue_note_items_1" required>
                                            <option>Select an Item</option>
                                        </select>
                                    </td>
                                    <td>
                                        {!! Form::text('quantity_req[]', null, ['class' => 'form-control', 'placeholder' => 'Quantity', 'id' => 'quantity_req', 'required', 'readonly']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('quantity_issue[]', null, ['class' => 'form-control quantity_issue', 'placeholder' => 'Add Issue', 'id' => 'quantity_issue', 'required']) !!}
                                        {!! Form::hidden('detail_id[]', null, ['class' => 'form-control detail_id', 'id' => 'jobDetail_id', 'required', 'value' => '']) !!}

                                    </td>
                                    <td class="text-center actions"><a id="delete-row" href="#"><i class="fa fa-times"></i></a></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-1">
                            <button class="btn btn-primary" type="button" class="addRow" id="addIssueNoteRow">add row</button>
                        </div>
                        <div class="col-lg-4">
                            {!! Form::submit('Save Issue Note', ['class' => 'btn btn-success']) !!}
                        </div>

                        <div class="col-lg-3">

                        </div>
                        <div class="col-lg-2">

                        </div>
                        <div class="col-lg-1">
                            {!! Form::reset('Reset Form', ['class' => 'btn btn-danger']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection