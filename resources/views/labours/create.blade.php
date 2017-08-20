@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Add New Labour Details</h3>
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
                    Labour Details Data Form
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

                    {!! Form::open(array('url' => url('labours'), 'class'=>'form-horizontal')) !!}

                    <div class="row">
                        <div class="form-group">
                                {!! Form::label('job_id', 'Job', ['class' => 'col-sm-1 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::select('job_id', ['' => 'Select a job'] + $jobs, null, array('class' => 'form-control', 'id' => 'labour_job_id', 'required')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row add-labour-data-section">
                        <div class="col-lg-12" id="labour-data-wrapper">
                            <table class="table table-bordered labour_create" id="dynamic-tbl">
                                <thead>
                                <th>Employee</th>
                                <th>Normal Hrs</th>
                                <th>OT Hrs</th>
                                <th>DOT Hrs</th>
                                <th>Other Hrs</th>
                                <th class="text-center">Actions</th>
                                </thead>
                                <tbody>
                                <tr id="1">
                                    <td>
                                        {!! Form::select('employee_id[]', ['' => 'Select an employee'] + $employees, null, array('class' => 'form-control', 'id' => 'employee_id', 'required')) !!}
                                    </td>
                                    <td>
                                        <div class="labour-time-wrapper form-group col-xs-6">
                                            {!! Form::text('normal_hrs[]', null, ['class' => 'form-control', 'placeholder' => 'HH']) !!}
                                        </div>

                                        <div class="labour-time-wrapper form-group col-xs-6">
                                            {!! Form::text('normal_min[]', null, ['class' => 'form-control', 'placeholder' => 'MM']) !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="labour-time-wrapper form-group col-xs-6">
                                            {!! Form::text('ot_hrs[]', null, ['class' => 'form-control', 'placeholder' => 'HH']) !!}
                                        </div>

                                        <div class="labour-time-wrapper form-group col-xs-6">
                                            {!! Form::text('ot_min[]', null, ['class' => 'form-control', 'placeholder' => 'MM']) !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="labour-time-wrapper form-group col-xs-6">
                                            {!! Form::text('dot_hrs[]', null, ['class' => 'form-control', 'placeholder' => 'HH']) !!}
                                        </div>

                                        <div class="labour-time-wrapper form-group col-xs-6">
                                            {!! Form::text('dot_min[]', null, ['class' => 'form-control', 'placeholder' => 'MM']) !!}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="labour-time-wrapper form-group col-xs-6">
                                            {!! Form::text('other_hrs[]', null, ['class' => 'form-control', 'placeholder' => 'HH']) !!}
                                        </div>

                                        <div class="labour-time-wrapper form-group col-xs-6">
                                            {!! Form::text('other_min[]', null, ['class' => 'form-control', 'placeholder' => 'MM']) !!}
                                        </div>
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
                            {!! Form::submit('Save Job Labour', ['class' => 'btn btn-success']) !!}
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