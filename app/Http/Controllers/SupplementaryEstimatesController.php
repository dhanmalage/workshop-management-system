<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Estimate;
use App\Customer;
use App\Department;
use App\Vehicle;
use App\Http\Requests\SupplementaryEstimateRequest;
use App\SupplementaryEstimate;
use App\SupplementaryEstimateDetail;
use Illuminate\Support\Facades\Auth;
use App\Job;
use DB;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\JobDetail;

class SupplementaryEstimatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_supplementary($id)
    {
        $job = DB::table('jobs')->where('estimate_id', '=', $id)->first();
        if($job->status == 'open') {
            $estimate = Estimate::findOrFail($id);
            $customer = Customer::findOrFail($estimate->customer_id);
            $vehicle = Vehicle::findOrFail($estimate->vehicle_id);
            $department = Department::findOrFail($estimate->department);
            $items = Item::lists('name', 'id')->all();
            return view('estimates/supplementary/create', compact('estimate', 'items', 'customer', 'vehicle', 'department'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplementaryEstimateRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        if($input['estimate_id'] != null){
            $supplementary_estimate = new SupplementaryEstimate();
            $supplementary_estimate->estimate_id = $input['estimate_id'];
            $supplementary_estimate->net_amount = $input['net_amount'];
            $supplementary_estimate->created_by = $user->id;

            $supplementary_estimate->save($request->all());

            $job = DB::table('jobs')->where('estimate_id', '=', $input['estimate_id'])->first();

            for($i=0;$i<count($input['item_id']);$i++)
            {
                $supplementary_estimate_detail = new SupplementaryEstimateDetail();
                $supplementary_estimate_detail->estimate_id = $input['estimate_id'];
                $supplementary_estimate_detail->item_id = $input['item_id'][$i];
                $supplementary_estimate_detail->item_description = $input['item_description'][$i];
                $supplementary_estimate_detail->units = $input['units'][$i];
                $supplementary_estimate_detail->rate = $input['rate'][$i];
                $supplementary_estimate_detail->initial_amount = $input['amount'][$i];
                $supplementary_estimate_detail->task_status = 'open';

                $supplementary_estimate->supplementary_estimate_details()->save($supplementary_estimate_detail);

                $job_detail = new JobDetail();
                $job_detail->job_id = $job->id;
                $job_detail->estimate_id = $input['estimate_id'];
                $job_detail->item_id = $input['item_id'][$i];
                $job_detail->item_description = $input['item_description'][$i];
                $job_detail->units = $input['units'][$i];
                $job_detail->balance_quantity = $input['units'][$i];
                $job_detail->quantity_issued = 0;
                $job_detail->rate = $input['rate'][$i];
                $job_detail->initial_amount = $input['amount'][$i];
                $job_detail->approved_amount = $input['amount'][$i];
                $job_detail->task_status = 'open';

                $job_detail->save();
            }

            DB::table('jobs')->where('estimate_id', $input['estimate_id'])->increment('grand_total', $input['net_amount']);

        }

        return redirect('/estimates/'.$input['estimate_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function print_supplementary($id)
    {
        $supplementary_estimates = SupplementaryEstimate::findOrFail($id);
        $supplementary_estimate_details = DB::table('supplementary_estimate_details')->where('supplementary_estimate_id', '=', $id)->get();

        $job = DB::table('jobs')->where('estimate_id', $supplementary_estimates->estimate_id)->first();

        $parameter = array();
        $parameter['supplementary_estimates'] = $supplementary_estimates;
        $parameter['supplementary_estimate_details'] = $supplementary_estimate_details;
        $parameter['job'] = $job;

        $pdf = PDF::loadView('estimates.supplementary.print-estimate', $parameter);
        return $pdf->stream('supplementary_estimate'.date("Y-m-d").'-'.$id.'.pdf');
    }

    public function download_supplementary($id)
    {
        $supplementary_estimates = SupplementaryEstimate::findOrFail($id);
        $supplementary_estimate_details = DB::table('supplementary_estimate_details')->where('supplementary_estimate_id', '=', $id)->get();

        $job = DB::table('jobs')->where('estimate_id', $supplementary_estimates->estimate_id)->first();

        $parameter = array();
        $parameter['supplementary_estimates'] = $supplementary_estimates;
        $parameter['supplementary_estimate_details'] = $supplementary_estimate_details;
        $parameter['job'] = $job;

        $pdf = PDF::loadView('estimates.supplementary.print-estimate', $parameter);
        return $pdf->download('supplementary_estimate'.date("Y-m-d").'-'.$id.'.pdf');
    }

}
