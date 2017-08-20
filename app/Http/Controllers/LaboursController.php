<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Estimate;
use App\Vehicle;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Job;
use App\Labour;
use App\LabourDetail;
use App\Http\Requests\LabourRequest;
use Illuminate\Support\Facades\Auth;
use App\Customer;

class LaboursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labours = DB::table('labours')
                    ->join('jobs', 'jobs.id', '=', 'labours.job_id')
                    ->selectRaw('labours.*, labours.id as labour_id, jobs.labour_status as labour_status, jobs.estimate_id as est_id')
                    ->groupBy('job_id')->get();
        return view('labours.labours', compact('labours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::where('labour_status', 'open')->orderBy('id')->lists('id', 'id')->all();
        $employees = Employee::lists('name', 'id')->all();

        return view('labours.create', compact('jobs', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabourRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        $labour = new Labour();
        $labour->job_id = $input['job_id'];
        $labour->created_by = $user->id;

        $labour->save($request->all());
        for($i=0;$i<count($input['employee_id']);$i++)
        {
            $labour_detail = new LabourDetail();
            $labour_detail->job_id = $input['job_id'];
            $labour_detail->employee_id = $input['employee_id'][$i];
            $labour_detail->normal_hrs = $input['normal_hrs'][$i];
            $labour_detail->normal_min = $input['normal_min'][$i];
            $labour_detail->ot_hrs = $input['ot_hrs'][$i];
            $labour_detail->ot_min = $input['ot_min'][$i];
            $labour_detail->dot_hrs = $input['dot_hrs'][$i];
            $labour_detail->dot_min = $input['dot_min'][$i];
            $labour_detail->other_hrs = $input['other_hrs'][$i];
            $labour_detail->other_min = $input['other_min'][$i];
            $labour->labour_details()->save($labour_detail);
        }

        return redirect('/labours');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $labour = Labour::findOrFail($id);
        $labour_details = DB::table('labour_details')
            ->where('labour_details.job_id', $labour->job_id)
            ->join('employees', 'employees.id', '=', 'labour_details.employee_id')
            ->join('employee_roles', 'employee_roles.id', '=', 'employees.role_id')
            ->get();
        $job = Job::findOrFail($labour->job_id);
        $estimate = Estimate::where('id', $job->estimate_id)->first();
        $customer = Customer::where('id', $estimate->customer_id)->first();
        $vehicle  = Vehicle::where('id', $estimate->vehicle_id)->first();

        return view('labours.single-labour', compact('labour', 'labour_details', 'job', 'estimate', 'customer', 'vehicle'));
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
