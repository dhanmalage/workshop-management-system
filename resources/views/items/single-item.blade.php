@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h3 class="page-header">Item Details</h3>
        </div>
        <div class="col-lg-9">
            <a href="{{url('items')}}" type="button" class="page-header btn btn-primary">All Items</a>
            <a href="{{url('items/create')}}" type="button" class="page-header btn btn-primary">New Item</a>
            <a href="{{url('items/'.$item->id.'/edit')}}" type="button" class="page-header btn btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title uppercase">{{$item->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <i class="fa fa-shopping-cart fa-5x"></i> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td class="uppercase">{{$item->name}}</td>
                                </tr>
                                <tr>
                                    <td>Type:</td>
                                    <td>
                                        @if($item->type == 'service')
                                            Service Item
                                        @elseif($item->type == 'part')
                                            Spare Part
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Location:</td>
                                    <td>{{$item->location}}</td>
                                </tr>
                                <tr><td>Quantity:</td>
                                    <td>{{$item->quantity}}</td>

                                </tr>
                                <tr><td>Sale Price:</td>
                                    <td>{{$item->sale_price}}</td>

                                </tr>
                                <tr><td>Internal Cost:</td>
                                    <td>{{$item->actual_cost}}</td>

                                </tr>
                                <tr><td>Unit of sale:</td>
                                    <td>{{$item->unit_of_sale}}</td>

                                </tr>
                                <tr><td>Re-Order level:</td>
                                    <td>{{$item->pre_order_level}}</td>

                                </tr>
                                <tr><td>Category:</td>
                                    <td>{{$item_cat->cat_name}}</td>

                                </tr>
                                <tr><td>VAT:</td>
                                    <td>@if($item->vat == 1)Yes @else No @endif</td>

                                </tr>
                                <tr><td>NBT:</td>
                                    <td>@if($item->nbt == 1)Yes @else No @endif</td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>

@endsection