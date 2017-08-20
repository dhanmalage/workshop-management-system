<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Request;
use App\Item;
use App\Http\Requests\ItemRequest;
use App\ItemCategory;
use Response;
use Illuminate\Support\Facades\Auth;
use DB;
use Input;

class ItemsController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $items = Item::all();
        $catagories = ItemCategory::all(['id', 'cat_name']);
        return view('items.items', compact('items', 'catagories'));
    }

    public function  create(){
        $catagories = ItemCategory::lists('cat_name', 'id');        
        return view('items.create')->with('catagories', $catagories);
    }
    
    public function  store(ItemRequest $request){

        $user = Auth::user();

        $input = $request->all();
        $item = new Item();
        $item->name = strtoupper($input['name']);
        $item->type = $input['type'];
        $item->location = $input['location'];
        $item->sale_price = $input['sale_price'];
        $item->unit_of_sale = $input['unit_of_sale'];
        $item->pre_order_level = $input['pre_order_level'];
        $item->created_by = $user->id;
        $item->category_id = $input['category_id'];
        /*$item->service_only_cost = $input['service_only_cost'];*/
        $item->vat = $input['vat'];
        $item->nbt = $input['nbt'];
        $item->save($request->all());
        
        return redirect('/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id)->first();
        $item_cat = DB::table('item_categories')->where('id', '=', $item->category_id)->first();
        return view('items.single-item', compact('item', 'item_cat'));
    }
    
    public function edit($id){
        $item = Item::findOrFail($id);
        $catagories = ItemCategory::lists('cat_name', 'id'); 
        return view('items.edit', compact('item', 'catagories'));
    }
    
    public function update($id, ItemRequest $request){
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return redirect('items');
    }
	
	    public function quick_add_item(Request $request)
    {
        $item_name = Input::get('name');
        $item_type = Input::get('type');
        $item_price = Input::get('sale_price');
        $item_vat = Input::get('vat');
        $item_nbt = Input::get('nbt');
        if($item_vat != null){
            $vat = Input::get('vat');
        }else{
            $vat = 0;
        }
        if($item_nbt != null){
            $nbt = Input::get('nbt');
        }else{
            $nbt = 0;
        }

        $user = Auth::user();

        $input = $request->all();
        $item = new Item();
        $item->name = $item_name;
        $item->type = $item_type;
        $item->sale_price = $item_price;
        $item->created_by = $user->id;
        $item->vat = $vat;
        $item->nbt = $nbt;
        $item->save();

        return Response::json(['item_id' => $item->id]);

    }
    
}
