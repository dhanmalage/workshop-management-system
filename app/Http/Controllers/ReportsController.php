<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.reports');
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
    public function store(Request $request)
    {
        //
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

    /**
     * Estimate No of vehicles report.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
     *
     * Estimate Vehicles Report
     */
    public function est_vehicles()
    {
        $date1 = Input::get('date1');
        $date2 = Input::get('date2');

        if(!empty($date1) && !empty($date2)){
            $vehicles = DB::table('estimates')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('customers', 'customers.id', '=', 'vehicles.customer_id')
                ->whereBetween('estimates.created_at', [$date1, $date2])
                ->selectRaw('vehicles.*, customers.id as customer_id, customers.name as customer_name')
                ->groupBy('estimates.vehicle_id')
                ->get();
            $new_date1 = strtotime($date1);
            $new_date1_format = date('Y-m-d',$new_date1);
            $new_date2 = strtotime($date2);
            $new_date2_format = date('Y-m-d',$new_date2);
            return view('reports.est-vehicles.est-vehicles', compact('vehicles', 'new_date1_format', 'new_date2_format'));
        }else {
            $vehicles = DB::table('estimates')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('customers', 'customers.id', '=', 'vehicles.customer_id')
                ->selectRaw('vehicles.*, customers.id as customer_id, customers.name as customer_name')
                ->groupBy('estimates.vehicle_id')
                ->get();
            return view('reports.est-vehicles.est-vehicles', compact('vehicles'));
        }
    }

    public function pdf_est_vehicles($date1 = null, $date2 = null)
    {
        if(!empty($date1) && !empty($date2)){
            $vehicles = DB::table('estimates')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('customers', 'customers.id', '=', 'vehicles.customer_id')
                ->whereBetween('estimates.created_at', [$date1, $date2])
                ->selectRaw('vehicles.*, customers.id as customer_id, customers.name as customer_name')
                ->groupBy('estimates.vehicle_id')
                ->get();
            $parameter['date1'] = $date1;
            $parameter['date2'] = $date2;
            $parameter['vehicles'] = $vehicles;
            $pdf = PDF::loadView('reports.est-vehicles.pdf-est-vehicles', $parameter);
            return $pdf->download('estimate-vehicles-'.$date1.'_'.$date2.'.pdf');
        }else {
            $vehicles = DB::table('estimates')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('customers', 'customers.id', '=', 'vehicles.customer_id')
                ->selectRaw('vehicles.*, customers.id as customer_id, customers.name as customer_name')
                ->groupBy('estimates.vehicle_id')
                ->get();
            $parameter['vehicles'] = $vehicles;
            $pdf = PDF::loadView('reports.est-vehicles.pdf-est-vehicles', $parameter);
            return $pdf->download('estimate-vehicles-'.date("Y-m-d").'.pdf');
        }
    }

    /*
     *
     * Pending Estimates Report
     */
    public function est_pending()
    {
        $date1 = Input::get('date1');
        $date2 = Input::get('date2');

        if(!empty($date1) && !empty($date2)) {
            $estimates = DB::table('estimates')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('departments', 'departments.id', '=', 'estimates.department')
                ->whereBetween('estimates.created_at', [$date1, $date2])
                ->selectRaw('estimates.*, estimates.id as est_id, estimates.created_at as est_date, customers.*, customers.id as c_id, customers.name as cname, vehicles.*, departments.*, departments.name as dname')
                ->get();
            $new_date1 = strtotime($date1);
            $new_date1_format = date('Y-m-d',$new_date1);
            $new_date2 = strtotime($date2);
            $new_date2_format = date('Y-m-d',$new_date2);
            return view('reports.est-pending.est-pending', compact('estimates', 'new_date1_format', 'new_date2_format'));
        }else{
            $estimates = DB::table('estimates')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('departments', 'departments.id', '=', 'estimates.department')
                ->selectRaw('estimates.*, estimates.id as est_id, estimates.created_at as est_date, customers.*, customers.id as c_id, customers.name as cname, vehicles.*, departments.*, departments.name as dname')
                ->get();
            return view('reports.est-pending.est-pending', compact('estimates'));
        }
    }

    public function pdf_est_pending($date1 = null, $date2 = null)
    {
        if(!empty($date1) && !empty($date2)){
            $estimates = DB::table('estimates')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('departments', 'departments.id', '=', 'estimates.department')
                ->whereBetween('estimates.created_at', [$date1, $date2])
                ->selectRaw('estimates.*, estimates.id as est_id, estimates.created_at as est_date, customers.*, customers.id as c_id, customers.name as cname, vehicles.*, departments.*, departments.name as dname')
                ->get();
            $parameter['date1'] = $date1;
            $parameter['date2'] = $date2;
            $parameter['estimates'] = $estimates;
            $pdf = PDF::loadView('reports.est-pending.pdf-est-pending', $parameter);
            return $pdf->download('estimates-pending-'.$date1.'_'.$date2.'.pdf');
        }else {
            $estimates = DB::table('estimates')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('departments', 'departments.id', '=', 'estimates.department')
                ->selectRaw('estimates.*, estimates.id as est_id, estimates.created_at as est_date, customers.*, customers.id as c_id, customers.name as cname, vehicles.*, departments.*, departments.name as dname')
                ->get();
            $parameter['estimates'] = $estimates;
            $pdf = PDF::loadView('reports.est-pending.pdf-est-pending', $parameter);
            return $pdf->download('estimate-pending-'.date("Y-m-d").'.pdf');
        }
    }


    /*
     *
     * Pending Open Jobs
     */
    public function jobs_open()
    {
        $date1 = Input::get('date1');
        $date2 = Input::get('date2');

        if(!empty($date1) && !empty($date2)) {
            $jobs = DB::table('jobs')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
                ->where('jobs.status', 'like', 'open')
                ->whereBetween('jobs.created_at', [$date1, $date2])
                ->selectRaw('jobs.*, jobs.id as job_id, jobs.created_at as job_date, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
                ->orderBy('jobs.id','DESC')->get();
            $new_date1 = strtotime($date1);
            $new_date1_format = date('Y-m-d',$new_date1);
            $new_date2 = strtotime($date2);
            $new_date2_format = date('Y-m-d',$new_date2);
            return view('reports.jobs.jobs-open', compact('jobs', 'new_date1_format', 'new_date2_format'));
        }else{
            $jobs = DB::table('jobs')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
                ->where('jobs.status', 'like', 'open')
                ->selectRaw('jobs.*, jobs.id as job_id, jobs.created_at as job_date, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
                ->orderBy('jobs.id','DESC')->get();
            return view('reports.jobs.jobs-open', compact('jobs'));
        }
    }

    public function pdf_jobs_open($date1 = null, $date2 = null)
    {
        if(!empty($date1) && !empty($date2)){
            $jobs = DB::table('jobs')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
                ->where('jobs.status', 'like', 'open')
                ->whereBetween('jobs.created_at', [$date1, $date2])
                ->selectRaw('jobs.*, jobs.id as job_id, jobs.created_at as job_date, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
                ->orderBy('jobs.id','DESC')->get();
            $parameter['date1'] = $date1;
            $parameter['date2'] = $date2;
            $parameter['jobs'] = $jobs;
            $pdf = PDF::loadView('reports.jobs.pdf-jobs-open', $parameter);
            return $pdf->download('jobs-open-'.$date1.'_'.$date2.'.pdf');
        }else {
            $jobs = DB::table('jobs')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
                ->where('jobs.status', 'like', 'open')
                ->selectRaw('jobs.*, jobs.id as job_id, jobs.created_at as job_date, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
                ->orderBy('jobs.id','DESC')->get();
            $parameter['jobs'] = $jobs;
            $pdf = PDF::loadView('reports.jobs.pdf-jobs-open', $parameter);
            return $pdf->download('jobs-open-'.date("Y-m-d").'.pdf');
        }
    }

/*
 *
 * Pending Completed Jobs
 */
    public function jobs_complete()
    {
        $date1 = Input::get('date1');
        $date2 = Input::get('date2');

        if(!empty($date1) && !empty($date2)) {
            $jobs = DB::table('jobs')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
                ->where('jobs.status', 'like', 'complete')
                ->whereBetween('jobs.created_at', [$date1, $date2])
                ->selectRaw('jobs.*, jobs.id as job_id, jobs.created_at as job_date, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
                ->orderBy('jobs.id','DESC')->get();
            $new_date1 = strtotime($date1);
            $new_date1_format = date('Y-m-d',$new_date1);
            $new_date2 = strtotime($date2);
            $new_date2_format = date('Y-m-d',$new_date2);
            return view('reports.jobs.jobs-complete', compact('jobs', 'new_date1_format', 'new_date2_format'));
        }else{
            $jobs = DB::table('jobs')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
                ->where('jobs.status', 'like', 'complete')
                ->selectRaw('jobs.*, jobs.id as job_id, jobs.created_at as job_date, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
                ->orderBy('jobs.id','DESC')->get();
            return view('reports.jobs.jobs-complete', compact('jobs'));
        }
    }

    public function pdf_jobs_complete($date1 = null, $date2 = null)
    {
        if(!empty($date1) && !empty($date2)){
            $jobs = DB::table('jobs')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
                ->where('jobs.status', 'like', 'complete')
                ->whereBetween('jobs.created_at', [$date1, $date2])
                ->selectRaw('jobs.*, jobs.id as job_id, jobs.created_at as job_date, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
                ->orderBy('jobs.id','DESC')->get();
            $parameter['date1'] = $date1;
            $parameter['date2'] = $date2;
            $parameter['jobs'] = $jobs;
            $pdf = PDF::loadView('reports.jobs.pdf-jobs-complete', $parameter);
            return $pdf->download('jobs-complete-'.$date1.'_'.$date2.'.pdf');
        }else {
            $jobs = DB::table('jobs')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('employees', 'employees.id', '=', 'jobs.s_adviser')
                ->where('jobs.status', 'like', 'complete')
                ->selectRaw('jobs.*, jobs.id as job_id, jobs.created_at as job_date, customers.*, customers.name as cname, vehicles.*, employees.*, employees.name as sname')
                ->orderBy('jobs.id','DESC')->get();
            $parameter['jobs'] = $jobs;
            $pdf = PDF::loadView('reports.jobs.pdf-jobs-complete', $parameter);
            return $pdf->download('jobs-complete-'.date("Y-m-d").'.pdf');
        }
    }

/*
 *
 * Job Invoices Reports
 */
    public function job_invoices()
    {
        $date1 = Input::get('date1');
        $date2 = Input::get('date2');

        if(!empty($date1) && !empty($date2)) {
            $invoices = DB::table('invoices')
                ->join('jobs', 'jobs.id', '=', 'invoices.job_id')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('insurance_companies', 'insurance_companies.id', '=', 'estimates.insurance_company')
                ->where('jobs.status', 'like', 'complete')
                ->whereBetween('invoices.created_at', [$date1, $date2])
                ->selectRaw('invoices.*, invoices.id as inv_id, invoices.created_at as inv_date, jobs.*, jobs.id as job_id, customers.*, customers.name as cname, customers.id as cid, vehicles.*, insurance_companies.name as insurance')
                ->orderBy('invoices.id','DESC')->get();
            $new_date1 = strtotime($date1);
            $new_date1_format = date('Y-m-d',$new_date1);
            $new_date2 = strtotime($date2);
            $new_date2_format = date('Y-m-d',$new_date2);
            return view('reports.invoices.job-invoices', compact('invoices', 'new_date1_format', 'new_date2_format'));
        }else{
            $invoices = DB::table('invoices')
                ->join('jobs', 'jobs.id', '=', 'invoices.job_id')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('insurance_companies', 'insurance_companies.id', '=', 'estimates.insurance_company')
                ->where('jobs.status', 'like', 'complete')
                ->selectRaw('invoices.*, invoices.id as inv_id, invoices.created_at as inv_date, jobs.*, jobs.id as job_id, customers.*, customers.name as cname, customers.id as cid, vehicles.*, insurance_companies.name as insurance')
                ->orderBy('invoices.id','DESC')->get();
            return view('reports.invoices.job-invoices', compact('invoices'));
        }
    }

    public function pdf_job_invoices($date1 = null, $date2 = null)
    {
        if(!empty($date1) && !empty($date2)){
            $invoices = DB::table('invoices')
                ->join('jobs', 'jobs.id', '=', 'invoices.job_id')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('insurance_companies', 'insurance_companies.id', '=', 'estimates.insurance_company')
                ->where('jobs.status', 'like', 'complete')
                ->whereBetween('invoices.created_at', [$date1, $date2])
                ->selectRaw('invoices.*, invoices.id as inv_id, invoices.created_at as inv_date, jobs.*, jobs.id as job_id, customers.*, customers.name as cname, customers.id as cid, vehicles.*, insurance_companies.name as insurance')
                ->orderBy('invoices.id','DESC')->get();
            $parameter['date1'] = $date1;
            $parameter['date2'] = $date2;
            $parameter['invoices'] = $invoices;
            $pdf = PDF::loadView('reports.invoices.pdf-job-invoices', $parameter);
            return $pdf->download('job-invoices'.$date1.'_'.$date2.'.pdf');
        }else {
            $invoices = DB::table('invoices')
                ->join('jobs', 'jobs.id', '=', 'invoices.job_id')
                ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
                ->join('customers', 'customers.id', '=', 'estimates.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
                ->join('insurance_companies', 'insurance_companies.id', '=', 'estimates.insurance_company')
                ->where('jobs.status', 'like', 'complete')
                ->selectRaw('invoices.*, invoices.id as inv_id, invoices.created_at as inv_date, jobs.*, jobs.id as job_id, customers.*, customers.name as cname, customers.id as cid, vehicles.*, insurance_companies.name as insurance')
                ->orderBy('invoices.id','DESC')->get();
            $parameter['invoices'] = $invoices;
            $pdf = PDF::loadView('reports.invoices.pdf-job-invoices', $parameter);
            return $pdf->download('job-invoices'.date("Y-m-d").'.pdf');
        }
    }



    /*
 *
 * Direct Invoices Reports
 */
    public function direct_invoices()
    {
        $date1 = Input::get('date1');
        $date2 = Input::get('date2');

        if(!empty($date1) && !empty($date2)) {
            $direct_invoices = DB::table('direct_invoices')
                ->join('customers', 'customers.id', '=', 'direct_invoices.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'direct_invoices.vehicle_id')
                ->whereBetween('direct_invoices.created_at', [$date1, $date2])
                ->selectRaw('direct_invoices.*, direct_invoices.id as inv_id, direct_invoices.created_at as inv_date, customers.*, customers.name as cname, customers.id as cid, vehicles.*')
                ->orderBy('direct_invoices.id','DESC')->get();
            $new_date1 = strtotime($date1);
            $new_date1_format = date('Y-m-d',$new_date1);
            $new_date2 = strtotime($date2);
            $new_date2_format = date('Y-m-d',$new_date2);
            return view('reports.invoices.direct-invoices', compact('direct_invoices', 'new_date1_format', 'new_date2_format'));
        }else{
            $direct_invoices = DB::table('direct_invoices')
                ->join('customers', 'customers.id', '=', 'direct_invoices.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'direct_invoices.vehicle_id')
                ->selectRaw('direct_invoices.*, direct_invoices.id as inv_id, direct_invoices.created_at as inv_date, customers.*, customers.name as cname, customers.id as cid, vehicles.*')
                ->orderBy('direct_invoices.id','DESC')->get();
            return view('reports.invoices.direct-invoices', compact('direct_invoices'));
        }
    }

    public function pdf_direct_invoices($date1 = null, $date2 = null)
    {
        if(!empty($date1) && !empty($date2)){
            $direct_invoices = DB::table('direct_invoices')
                ->join('customers', 'customers.id', '=', 'direct_invoices.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'direct_invoices.vehicle_id')
                ->whereBetween('direct_invoices.created_at', [$date1, $date2])
                ->selectRaw('direct_invoices.*, direct_invoices.id as inv_id, direct_invoices.created_at as inv_date, customers.*, customers.name as cname, customers.id as cid, vehicles.*')
                ->orderBy('direct_invoices.id','DESC')->get();
            $parameter['date1'] = $date1;
            $parameter['date2'] = $date2;
            $parameter['direct_invoices'] = $direct_invoices;
            $pdf = PDF::loadView('reports.invoices.pdf-direct-invoices', $parameter);
            return $pdf->download('direct-invoices'.$date1.'_'.$date2.'.pdf');
        }else {
            $direct_invoices = DB::table('direct_invoices')
                ->join('customers', 'customers.id', '=', 'direct_invoices.customer_id')
                ->join('vehicles', 'vehicles.id', '=', 'direct_invoices.vehicle_id')
                ->selectRaw('direct_invoices.*, direct_invoices.id as inv_id, direct_invoices.created_at as inv_date, customers.*, customers.name as cname, customers.id as cid, vehicles.*')
                ->orderBy('direct_invoices.id','DESC')->get();
            $parameter['direct_invoices'] = $direct_invoices;
            $pdf = PDF::loadView('reports.invoices.pdf-direct-invoices', $parameter);
            return $pdf->download('direct-invoices'.date("Y-m-d").'.pdf');
        }
    }




}
