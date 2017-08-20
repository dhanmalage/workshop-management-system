@extends('admin')
@section('content')

    <div class="row">
        <div class="col-lg-2">
            <h3 class="page-header">Items</h3>
        </div>
        <div class="col-lg-10">
        <a href="{{url('items/create')}}" type="button" class="page-header btn btn-primary">New Item</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Item Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-function">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th width="70px">Type</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th>Sale Price</th>
                                    <th>Internal Cost</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr class="odd gradeX">
                                    <td><a href="{{url('items/'.$item->id)}}" title="view">{{$item->id}}</a></td>
                                    <td><a href="{{url('items/'.$item->id)}}" class="uppercase" title="view">{{$item->name}}</a></td>
                                    <td width="70px">
                                        @if($item->type == 'service')
                                            Service Item
                                        @elseif($item->type == 'part')
                                            Spare Part
                                        @endif
                                    </td>
                                    <td>@if($item->category_id)
                                        @foreach($catagories as $catagory)
                                        @if($item->category_id == $catagory->id)
                                           {{$catagory->cat_name}}
                                        @endif
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>{{$item->location}}</td>
                                    <td class="center">{{$item->sale_price}}</td>
                                    <td class="center">{{$item->actual_cost}}</td>
                                    <td class="text-center actions">
                                        <a href="{{url('items/'.$item->id)}}" title="view"><i class="fa fa-newspaper-o"></i></a>
                                        <a href="{{url('items/'.$item->id.'/edit')}}"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>                   
                    
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


@endsection