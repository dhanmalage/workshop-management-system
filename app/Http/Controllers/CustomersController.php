<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use DB;
use App\Vehicle;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{

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
        $customers = Customer::all();
        //$vehicles = Vehicle::all();
        return view('customers.customers', compact('customers', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();
        $customer = new Customer();
        $customer->name = strtoupper($input['name']);
        $customer->address1 = strtoupper($input['address1']);
        $customer->address2 = strtoupper($input['address2']);
        $customer->city = $input['city'];
        $customer->dob = $input['dob'];
        $customer->telephone = $input['telephone'];
        $customer->mobile = $input['mobile'];
        $customer->email = $input['email'];
        $customer->fax = $input['fax'];
        $customer->website = $input['website'];
        $customer->vat_no = $input['vat_no'];
        $customer->contact_person = $input['contact_person'];
        $customer->credit_limit = $input['credit_limit'];
        $customer->account_sys_id = $input['account_sys_id'];
        $customer->how = $input['how'];
        $customer->created_by = $user->id;
        $customer->save($request->all());

        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $user = DB::table('users')->where('id', '=', $customer->created_by)->get();
        $vehicles = DB::table('vehicles')->where('customer_id', '=', $id)->get();
        return view('customers.single-customer', compact('customer', 'user', 'vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return redirect('customers');
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
	
	public function quick_add_customer(CustomerRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        $customer = new Customer();

        $customer->name = $input['name'];
        $customer->address1 = $input['address1'];
		$customer->telephone = $input['telephone'];
		$customer->mobile = $input['mobile'];
        $customer->created_by = $user->id;

        $customer->save($request->all());

        $input = $request->all();
        $vehicle = new Vehicle();
        $vehicle->customer_id = $customer->id;
        $vehicle->reg_no = $input['reg_no'];
        $vehicle->make = $input['make'];
        $vehicle->model = $input['model'];
        $vehicle->created_by = $user->id;

        $vehicle->save($request->all());

        return redirect('/estimates/create');
    }
	
	public function direct_invoice_quick_add_customer(CustomerRequest $request)
	{
		$user = Auth::user();

        $input = $request->all();

        $customer = new Customer();

        $customer->name = $input['name'];
        $customer->address1 = $input['address1'];
		$customer->telephone = $input['telephone'];
		$customer->mobile = $input['mobile'];
        $customer->created_by = $user->id;

        $customer->save($request->all());

        $input = $request->all();
        $vehicle = new Vehicle();
        $vehicle->customer_id = $customer->id;
        $vehicle->reg_no = $input['reg_no'];
        $vehicle->make = $input['make'];
        $vehicle->model = $input['model'];
        $vehicle->created_by = $user->id;

        $vehicle->save($request->all());

        return redirect('/direct_invoices/create');
	}
	
}
