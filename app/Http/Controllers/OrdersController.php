<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Item;
use App\OrderDetail;
use App\Supplier;
use App\Http\Requests\OrderRequest;
use DB;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$orders = Order::orderBy('id','DESC')->get();
        $suppliers = Supplier::all();*/

        $orders = DB::table('orders')
            ->join('suppliers', 'suppliers.id', '=', 'orders.supplier_id')
            ->selectRaw('orders.*, suppliers.name as sname')
            ->orderBy('orders.id','DESC')->get();

        return view('orders.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::lists('name', 'id')->all();
        $items = Item::lists('name', 'id')->all();
        return view('orders.create', compact('suppliers', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        $order = new Order();
        $order->supplier_id = $input['supplier_id'];
        $order->total = $input['total'];
        $order->order_status = 'open';
        $order->created_by = $user->id;

        $order->save($request->all());

        for($i=0;$i<count($input['item_id']);$i++)
        {
            $order_detail = new OrderDetail();
            $order_detail->item_id = $input['item_id'][$i];
            $order_detail->item_description = $input['item_description'][$i];
            $order_detail->quantity = $input['quantity'][$i];
            $order_detail->price = $input['price'][$i];
            $order_detail->balance_quantity = $input['quantity'][$i];
            $order_detail->status = 'open';

            $order->order_details()->save($order_detail);
        }

        return redirect('/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order_details = DB::table('order_details')->where('order_id', '=', $id)->get();
        $supplier = Supplier::where('id', '=', $order->supplier_id)->firstOrFail();
        $created_at = $order->created_at->format('Y M d');
        return view('orders.single-order', compact('order', 'order_details' , 'supplier', 'created_at'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
