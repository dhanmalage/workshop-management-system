<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Vehicle;
use App\Http\Requests\VehicleRequest;
use DB;
use Illuminate\Support\Facades\Auth;

class VehiclesController extends Controller
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
        $vehicles = DB::table('vehicles')
            ->join('customers', 'customers.id', '=', 'vehicles.customer_id')
            ->selectRaw('vehicles.*, vehicles.id as vid, customers.name as cname')
            ->get();
        return view('vehicles.vehicles', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();
        $vehicle = new Vehicle();
        $vehicle->customer_id = $input['customer_id'];
        $vehicle->reg_no = strtoupper($input['reg_no']);
        $vehicle->make = strtoupper($input['make']);
        $vehicle->model = strtoupper($input['model']);
        $vehicle->year = $input['year'];
        $vehicle->chasis_no = $input['chasis_no'];
        $vehicle->next_service = $input['next_service'];
        $vehicle->created_by = $user->id;
        $vehicle->save($request->all());

        return redirect('/customers/'.$input['customer_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.single-vehicle', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRequest $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());
        return redirect('vehicles');
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
