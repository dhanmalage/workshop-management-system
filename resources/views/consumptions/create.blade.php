@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <h3 class="page-header">Add New Consumption Details</h3>
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
                    Consumption Details Data Form
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

                    {!! Form::open(array('url' => url('consumptions'), 'class'=>'form-horizontal')) !!}

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
                                    <th>Consumption Name</th>
                                    <th>Amount</th>
                                    <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <tr id="1">
                                        <td>
                                            {!! Form::textarea('description[]', null, ['class' => 'form-textarea form-control', 'placeholder' => 'Consumption Description']) !!}
                                        </td>
                                        <td>
                                            {!! Form::text('amount[]', null, ['class' => 'form-control', 'placeholder' => 'Amount']) !!}
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
                            <div class="col-lg-11">
                                {!! Form::submit('Save Job Consumptions', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection