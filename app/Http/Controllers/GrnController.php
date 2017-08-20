<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grn;
use App\GrnDetail;
use DB;
use App\Order;
use App\OrderDetail;
use App\Supplier;
use App\Http\Requests\GrnRequest;
use Illuminate\Support\Facades\Auth;

class GrnController extends Controller
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
        $grns = DB::table('grns')
            ->join('suppliers', 'suppliers.id', '=', 'grns.supplier_id')
            ->selectRaw('grns.*, grns.id as grn_id, grns.created_at as date, suppliers.*, suppliers.name as sname')
            ->orderBy('grns.id','DESC')->get();
        return view('grns.grns', compact('grns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::lists('name', 'id')->all();
        return view('grns.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrnRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        $grn = new Grn();
        $grn->supplier_id = $input['supplier_id'];
        $grn->created_by = $user->id;

        $grn->save($request->all());

        for($i=0;$i<count($input['item_id']);$i++)
        {
            if($input['quantity_in'][$i] != null || $input['quantity_in'][$i] != 0) {
                $grn_detail = new GrnDetail();
                $grn_detail->order_id = $input['order_id'][$i];
                $grn_detail->item_id = $input['item_id'][$i];
                $grn_detail->item_description = $input['item_description'][$i];
                $grn_detail->quantity = $input['quantity'][$i];
                $grn_detail->quantity_in = $input['quantity_in'][$i];

                if ($input['quantity'][$i] == $input['quantity_in'][$i]) {
                    $grn_detail->status = 'complete';
                    DB::table('order_details')->where('id', $input['order_detail_id'][$i])->update(['status' => 'complete']);
                } elseif ($input['quantity'][$i] > $input['quantity_in'][$i]) {
                    $grn_detail->status = 'open';
                }

                $item = DB::table('items')->where('id', $input['item_id'][$i])->first();
                $item_total_cost = $item->quantity * $item->actual_cost;

                $order_item = DB::table('order_details')
                    ->where('order_id', $input['order_id'][$i])
                    ->where('item_id', $input['item_id'][$i])
                    ->first();
                $item_new_total_cost = $order_item->price * $input['quantity_in'][$i];

                $item_new_quantity = $item->quantity + $input['quantity_in'][$i];
                $item_total_cost = $item_total_cost + $item_new_total_cost;
                $item_new_cost = $item_total_cost / $item_new_quantity;

                DB::table('items')->where('id', $input['item_id'][$i])->update(['actual_cost' => $item_new_cost]);

                DB::table('items')->where('id', $input['item_id'][$i])->increment('quantity', $input['quantity_in'][$i]);

                DB::table('order_details')->where('id', $input['order_detail_id'][$i])->increment('quantity_in', $input['quantity_in'][$i]);

                DB::table('order_details')->where('id', $input['order_detail_id'][$i])->decrement('balance_quantity', $input['quantity_in'][$i]);

                $grn->grn_details()->save($grn_detail);
            }
        }

        return redirect('/grn');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grn = Grn::findOrFail($id);
        $grn_details = DB::table('grn_details')->where('grn_id', '=', $id)->get();
        $supplier = DB::table('suppliers')->where('id', '=', $grn->supplier_id)->first();

        return view('grns.single-grn', compact('grn', 'grn_details', 'supplier'));
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

    public function create_grn($id)
    {
        $order = Order::findOrFail($id);
        $order_details = DB::table('order_details')->where('order_id', '=', $id)->get();
        $items = Item::all();
        return view('grns.create-by-order', compact('order', 'order_details', 'items'));
    }
}
