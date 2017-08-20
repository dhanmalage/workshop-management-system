<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\Job;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Estimate;
use App\EstimateDetail;
use App\Department;
use App\Stakeholder;
use DB;
use App\Vehicle;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\InsuranceCompany;
use App\JobDetail;

class JobsController extends Controller
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
        $jobs = DB::table('jobs')
            ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
            ->join('customers', 'customers.id', '=', 'estimates.customer_id')
            ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
            ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
            ->selectRaw('jobs.*, jobs.id as job_id, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
            ->orderBy('jobs.id','DESC')->get();
        //var_dump($jobs); die;
        return view('jobs.jobs', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_job($est_id)
    {
        $job = DB::table('jobs')->where('estimate_id', '=', $est_id)->first();
        $estimate = Estimate::findOrFail($est_id);
        /*$estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $est_id)->get();
        $department = Department::findOrFail($estimate->department);*/
        /*$s_advisor_list = DB::table('stakeholders')->where('role', '=', 'Service Advisor')->lists('name', 'id');
        $sec_incharge_list = DB::table('stakeholders')->where('role', '=', 'Section Incharge')->lists('name', 'id');*/
        $employees = DB::table('employees')->lists('name', 'id');
        $customer = Customer::findOrFail($estimate->customer_id);
        $vehicle = Vehicle::findOrFail($estimate->vehicle_id);
        if($job != null){
            //return view('jobs.single-job', compact('job', 'estimate', 'estimate_details', 'department', 's_advisor_list', 'customer', 'vehicle', 'sec_incharge_list'));
            return redirect('jobs/'.$job->id);
        }else{
            return view('jobs.create', compact('estimate', 'employees', 'customer', 'vehicle'));
        }

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
    public function store(JobRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();

        $estimate = DB::table('estimates')->where('id', $input['estimate_id'])->first();
        $job = new Job();
        $job->estimate_id = $input['estimate_id'];
        $job->promised_date = $input['promised_date'];
        $job->section_incharge = $input['section-incharge'];
        $job->s_adviser = $input['advisor'];
        $job->remarks = $input['remark'];
        $job->status = 'open';
        $job->grand_total = $estimate->net_amount;
        $job->labour_status = 'open';
        $job->consumptions_status = 'open';
        $job->created_by = $user->id;
        $job->save($request->all());

        $estimate_details = DB::table('estimate_details')->where('estimate_id', $input['estimate_id'])->get();

        foreach($estimate_details as $detail)
        {
            $job_detail = new JobDetail();
            $job_detail->estimate_id = $input['estimate_id'];
            $job_detail->item_id = $detail->item_id;
            $job_detail->item_description = $detail->item_description;
            $job_detail->units = $detail->units;
            $job_detail->balance_quantity = $detail->balance_quantity;
            $job_detail->quantity_issued = $detail->quantity_issued;
            $job_detail->rate = $detail->rate;
            $job_detail->initial_amount = $detail->initial_amount;
            $job_detail->approved_amount = $detail->approved_amount;
            $job_detail->task_status = $detail->task_status;

            $job->job_details()->save($job_detail);
        }

        DB::table('estimates')->where('id', $input['estimate_id'])->update(['job_id' => $job->id]);

        return redirect('/jobs/'.$job->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        $job_details = DB::table('job_details')->where('job_id', '=', $id)->get();
        $estimate = Estimate::findOrFail($job->estimate_id);
        //$estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $job->estimate_id)->get();
        /*
        $supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $id)->get();
        if(isset($supplementary_estimates)) {
            $supplementary_estimate_details = DB::table('supplementary_estimates')
                ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
                ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
                ->where('supplementary_estimates.estimate_id', '=', $id)->get();
        }
        */

        $department = DB::table('departments')->where('id', '=', $estimate->department)->first();
        $s_advisor = DB::table('employees')->where('id', '=', $job->s_adviser)->first();
        $sec_incharge = DB::table('employees')->where('id', '=', $job->section_incharge)->first();
        $customer = Customer::findOrFail($estimate->customer_id);
        $vehicle = Vehicle::findOrFail($estimate->vehicle_id);
        $insurance_company = DB::table('insurance_companies')->where('id', '=', $estimate->insurance_company)->first();

        return view('jobs.single-job', compact('job', 'estimate', 'job_details', 'department', 's_advisor', 'customer', 'vehicle', 'sec_incharge', 'insurance_company'));
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

    /**
     * Complete Job.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function job_done($id)
    {
        if($id != null){
            DB::table('jobs')
                ->where('id', $id)
                ->update(['status' => 'job_done']);
        }

        return redirect('jobs/'.$id);
    }

    /*
     *
     * Labour Finish
     */
    public function labour_complete($id)
    {
        if($id != null){
            DB::table('jobs')
                ->where('id', $id)
                ->update(['labour_status' => 'complete']);
        }

        return redirect('jobs/'.$id);
    }

    public function consumption_complete($id)
    {
        if($id != null){
            DB::table('jobs')
                ->where('id', $id)
                ->update(['consumptions_status' => 'complete']);
        }

        return redirect('jobs/'.$id);
    }

    /*
     * PDF print
     *
     */
    public function print_job($id)
    {
        $job = Job::findOrFail($id);
        $job_details = DB::table('job_details')->where('job_id', '=', $id)->get();
        $estimate = Estimate::findOrFail($job->estimate_id);
        /*
        $estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $job->estimate_id)->get();

        $supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $id)->get();
        if(isset($supplementary_estimates)) {
            $supplementary_estimate_details = DB::table('supplementary_estimates')
                ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
                ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
                ->where('supplementary_estimates.estimate_id', '=', $id)->get();
        }
        */
        $department = DB::table('departments')->where('id', '=', $estimate->department)->first();
        $s_advisor = DB::table('employees')->where('id', '=', $job->s_adviser)->first();
        $sec_incharge = DB::table('employees')->where('id', '=', $job->section_incharge)->first();
        $customer = Customer::findOrFail($estimate->customer_id);
        $vehicle = Vehicle::findOrFail($estimate->vehicle_id);
        $insurance_company = DB::table('insurance_companies')->where('id', '=', $estimate->insurance_company)->first();

        $parameter = array();
        $parameter['job'] = $job;
        $parameter['job_details'] = $job_details;
        $parameter['estimate'] = $estimate;
        /*
        $parameter['estimate_details'] = $estimate_details;
        $parameter['supplementary_estimates'] = $supplementary_estimates;
        $parameter['supplementary_estimate_details'] = $supplementary_estimate_details;
        */
        $parameter['s_advisor'] = $s_advisor;
        $parameter['sec_incharge'] = $sec_incharge;
        $parameter['department'] = $department;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['insurance_company'] = $insurance_company;

        $pdf = PDF::loadView('jobs.print-job', $parameter);
        return $pdf->stream('job'.date("Y-m-d").'-'.$id.'.pdf');
    }

    /*
     *
     * PDF Download
     */
    public function download_job($id)
    {
        $job = Job::findOrFail($id);
        $job_details = DB::table('job_details')->where('job_id', '=', $id)->get();
        $estimate = Estimate::findOrFail($job->estimate_id);
        /*
        $estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $job->estimate_id)->get();

        $supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $id)->get();
        if(isset($supplementary_estimates)) {
            $supplementary_estimate_details = DB::table('supplementary_estimates')
                ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
                ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
                ->where('supplementary_estimates.estimate_id', '=', $id)->get();
        }
        */

        $department = DB::table('departments')->where('id', '=', $estimate->department)->first();
        $s_advisor = DB::table('employees')->where('id', '=', $job->s_adviser)->first();
        $sec_incharge = DB::table('employees')->where('id', '=', $job->section_incharge)->first();
        $customer = Customer::findOrFail($estimate->customer_id);
        $vehicle = Vehicle::findOrFail($estimate->vehicle_id);
        $insurance_company = DB::table('insurance_companies')->where('id', '=', $estimate->insurance_company)->first();

        $parameter = array();
        $parameter['job'] = $job;
        $parameter['job_details'] = $job_details;
        $parameter['estimate'] = $estimate;
        /*
        $parameter['estimate_details'] = $estimate_details;
        $parameter['supplementary_estimates'] = $supplementary_estimates;
        $parameter['supplementary_estimate_details'] = $supplementary_estimate_details;
        */
        $parameter['s_advisor'] = $s_advisor;
        $parameter['sec_incharge'] = $sec_incharge;
        $parameter['department'] = $department;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['insurance_company'] = $insurance_company;

        $pdf = PDF::loadView('jobs.print-job', $parameter);
        return $pdf->download('job'.date("Y-m-d").'-'.$id.'.pdf');
    }

}
