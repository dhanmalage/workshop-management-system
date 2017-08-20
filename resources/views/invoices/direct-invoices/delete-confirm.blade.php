@extends('admin')
@section('content')
    @role('owner')
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header">Are you sure you want to delete <strong>KAE/D-INV/{{$invoice->id}}</strong> Invoice ?</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Direct Invoice Delete
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    {!! Form::open([ 'method'  => 'delete', 'route' => [ 'direct_invoices.destroy', $invoice->id ] ]) !!}
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="form-group">
                                {!! Form::label('id', 'Invoice Number: ', ['class' => 'col-sm-5 control-label']) !!}
                                <div class="col-sm-7">
                                    <h4>KAE/D-INV/{{$invoice->id}}</h4>
                                </div>
                            </div>

                        </div>

                    <div class="col-lg-6">
                        <div class="col-lg-4">
                            {!! Form::submit('Delete Invoice', ['class' => 'btn btn-danger']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    </div>

    @endrole

@endsection