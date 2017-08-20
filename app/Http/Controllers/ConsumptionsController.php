<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Consumption;
use DB;
use App\Job;
use App\Http\Requests\ConsumptionRequest;
use App\ConsumptionDetail;
use Illuminate\Support\Facades\Auth;
use App\Estimate;
use App\Customer;
use App\Vehicle;

class ConsumptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumptions = DB::table('consumptions')
            ->join('jobs', 'jobs.id', '=', 'consumptions.job_id')
            ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
            ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
            ->selectRaw('consumptions.*, consumptions.id as con_id, consumptions.total as con_total, jobs.*, jobs.id as job_id, estimates.id as estimate_id, vehicles.*')
            ->groupBy('consumptions.job_id')->get();
        return view('consumptions.consumptions', compact('consumptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::where('consumptions_status', 'open')->orderBy('id')->lists('id', 'id')->all();
        return view('consumptions.create', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumptionRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        $consumption = new Consumption();
        $consumption->job_id = $input['job_id'];
        $consumption->created_by = $user->id;

        $consumption->save($request->all());
        for($i=0;$i<count($input['description']);$i++)
        {
            $consumption_detail = new ConsumptionDetail();
            $consumption_detail->job_id = $input['job_id'];
            $consumption_detail->description = $input['description'][$i];
            $consumption_detail->amount = $input['amount'][$i];
            $consumption->consumption_details()->save($consumption_detail);
        }

        return redirect('/consumptions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $consumption = Consumption::findOrFail($id);
        $consumption_details = DB::table('consumption_details')
            ->where('consumption_details.job_id', $consumption->job_id)->get();
        $job = Job::findOrFail($consumption->job_id);
        $estimate = Estimate::where('id', $job->estimate_id)->first();
        $customer = Customer::where('id', $estimate->customer_id)->first();
        $vehicle  = Vehicle::where('id', $estimate->vehicle_id)->first();
        $total = DB::table('consumption_details')->where('job_id', '=', $consumption->job_id)->sum('amount');

        return view('consumptions.single-consumption', compact('consumption', 'consumption_details', 'job', 'estimate', 'customer', 'vehicle', 'total'));

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
