<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EstimateDetail;
use App\ItemCategory;
use App\Job;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Estimate;
use App\Customer;
use App\Department;
use App\Item;
use App\Http\Requests\EstimateRequest;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\VehiclesController;
use DB;
use App\EstimateType;
use App\SupplementaryEstimate;
use App\SupplementaryEstimateDetail;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\InsuranceCompany;

class EstimatesController extends Controller
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
       $estimates = DB::table('estimates')
            ->join('customers', 'customers.id', '=', 'estimates.customer_id')
            ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
            ->join('departments', 'departments.id', '=', 'estimates.department')
            ->selectRaw('estimates.*, estimates.id as est_id, estimates.created_at as est_date, customers.*, customers.id as c_id, customers.name as cname, vehicles.*, departments.*, departments.name as dname')
            ->get();

        return view('estimates.estimates', compact('estimates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer_list = Customer::lists('name', 'id')->all();
        $departments = Department::lists('name', 'id')->all();
        $items = Item::lists('name', 'id')->all();
        $insurance_company = InsuranceCompany::lists('name', 'id')->all();
        $estimate_types = EstimateType::lists('estimate_type', 'id')->all();
        $sales_reps = Employee::where('role_id', '=', 4)->lists('name', 'id')->all();

        return view('estimates.create', compact('customer_list', 'departments', 'items', 'insurance_company', 'sales_reps', 'estimate_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstimateRequest $request)
    {

        $user = Auth::user();

        $input = $request->all();

        if($input['vehicle_id'] != null){
            $estimate = new Estimate();
            $estimate->customer_id = $input['customer_id'];
            $estimate->vehicle_id = $input['vehicle_id'];
            $estimate->mileage_in = $input['mileage_in'];
            $estimate->department = $input['department'];
            $estimate->estimate_type = $input['estimate_type'];
            $estimate->insurance_company = $input['insurance_company'];
            $estimate->sales_rep = $input['sales_rep'];
            $estimate->net_amount = $input['net_amount'];
            $estimate->created_by = $user->id;

            $estimate->save($request->all());

            for($i=0;$i<count($input['item_id']);$i++)
            {
                $estimate_detail = new EstimateDetail();
                $estimate_detail->item_id = $input['item_id'][$i];
                $estimate_detail->item_description = $input['item_description'][$i];
                $estimate_detail->units = $input['units'][$i];
                $estimate_detail->balance_quantity = $input['units'][$i];
                $estimate_detail->quantity_issued = 0;
                $estimate_detail->rate = $input['rate'][$i];
                $estimate_detail->initial_amount = $input['amount'][$i];
                $estimate_detail->approved_amount = $input['amount'][$i];
                $estimate_detail->task_status = 'open';

                $estimate->estimate_details()->save($estimate_detail);
            }

        }else{

            $vehicle = new Vehicle();
            $vehicle->customer_id = $input['customer_id'];
            $vehicle->reg_no = $input['reg_no'];
            $vehicle->make = $input['make'];
            $vehicle->model = $input['model'];
            $vehicle->created_by = $user->id;

            $estimate = new Estimate();
            $estimate->customer_id = $input['customer_id'];
            $estimate->mileage_in = $input['mileage_in'];
            $estimate->department = $input['department'];
            $estimate->estimate_type = $input['estimate_type'];
            $estimate->insurance_company = $input['insurance_company'];
            $estimate->sales_rep = $input['sales_rep'];
            $estimate->net_amount = $input['net_amount'];
            $estimate->created_by = $user->id;

            $vehicle->save($request->all());
            $vehicle->estimate()->save($estimate);

            for($i=0;$i<count($input['item_id']);$i++)
            {
                $estimate_detail = new EstimateDetail();
                $estimate_detail->item_id = $input['item_id'][$i];
                $estimate_detail->item_description = $input['item_description'][$i];
                $estimate_detail->units = $input['units'][$i];
                $estimate_detail->balance_quantity = $input['units'][$i];
                $estimate_detail->rate = $input['rate'][$i];
                $estimate_detail->initial_amount = $input['amount'][$i];
                $estimate_detail->approved_amount = $input['amount'][$i];
                $estimate_detail->task_status = 'open';

                $estimate->estimate_details()->save($estimate_detail);
            }

        }

        return redirect('/estimates/'.$estimate->id);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estimate = Estimate::findOrFail($id);
        $estimate_details = DB::table('estimate_details')
                                ->join('items', 'items.id', '=', 'estimate_details.item_id')
                                ->selectRaw('estimate_details.*, items.type')
                                ->where('estimate_details.estimate_id', '=', $id)->get();
        $supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $id)->get();
        $supplementary_estimate_details = DB::table('supplementary_estimates')
                                ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
                                ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
                                ->where('supplementary_estimates.estimate_id', '=', $id)->get();
        //$sales_rep = Employee::where('id', '=', $estimate->sales_rep)->firstOrFail();
        $department = Department::where('id', '=', $estimate->department)->firstOrFail();
        $est_type = EstimateType::where('id', '=', $estimate->estimate_type)->firstOrFail();
        $customer = Customer::where('id', '=', $estimate->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $estimate->vehicle_id)->firstOrFail();
        $job = DB::table('jobs')->where('estimate_id', $estimate->id)->first();
        $insurance_company = InsuranceCompany::where('id', '=', $estimate->insurance_company)->first();

        return view('estimates.single-estimate', compact('estimate', 'estimate_details', 'supplementary_estimates', 'supplementary_estimate_details', 'department', 'est_type', 'sales_rep', 'customer', 'vehicle', 'job', 'insurance_company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estimate = Estimate::findOrFail($id);
        if($estimate->job_id != null){
            return redirect('estimates/'.$id);
        }else{
            $vehicles = Vehicle::lists('reg_no', 'id')->all();
            $customer_list = Customer::lists('name', 'id')->all();
            $departments = Department::lists('name', 'id');
            $est_type = EstimateType::lists('estimate_type', 'id');
            $insurance_company = InsuranceCompany::lists('name', 'id')->all();
            $sales_rep = Employee::lists('name', 'id')->all();
            $items = Item::lists('name', 'id')->all();
            $estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $id)->get();
            return view('estimates.edit', compact('estimate', 'vehicles', 'estimate_details', 'customer_list', 'departments', 'sales_rep', 'est_type', 'items', 'insurance_company'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstimateRequest $request, $id)
    {
        $estimate = Estimate::findOrFail($id);
        $estimate->update($request->all());



        $input = $request->all();

        DB::table('estimate_details')->where('estimate_id', '=', $id)->delete();

        for($i=0;$i<count($input['item_id']);$i++)
        {
            if($input['item_id'][$i] != null) {
                $estimate_detail = new EstimateDetail();
                $estimate_detail->item_id = $input['item_id'][$i];
                $estimate_detail->item_description = $input['item_description'][$i];
                $estimate_detail->units = $input['units'][$i];
                $estimate_detail->rate = $input['rate'][$i];
                $estimate_detail->initial_amount = $input['amount'][$i];
                $estimate_detail->approved_amount = $input['approved_amount'][$i];

                $estimate->estimate_details()->save($estimate_detail);
            }
        }

        return redirect('estimates/'.$estimate->id);
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

    public function print_estimate($id)
    {
        $estimate = Estimate::findOrFail($id);
        $estimate_details = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->selectRaw('estimate_details.*, items.type')
            ->where('estimate_details.estimate_id', '=', $id)->get();
        $services_count = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->where('estimate_details.estimate_id', '=', $id)
            ->where('items.type', '=', 'service')->count();
        $parts_count = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->where('estimate_details.estimate_id', '=', $id)
            ->where('items.type', '=', 'part')->count();
        /*$supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $id)->get();
        $supplementary_estimate_details = DB::table('supplementary_estimates')
            ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
            ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
            ->where('supplementary_estimates.estimate_id', '=', $id)->get();*/

        $department = Department::where('id', '=', $estimate->department)->firstOrFail();
        $customer = Customer::where('id', '=', $estimate->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $estimate->vehicle_id)->firstOrFail();
        $job = DB::table('jobs')->where('estimate_id', $estimate->id)->first();
        $insurance_company = InsuranceCompany::where('id', '=', $estimate->insurance_company)->first();

        $parameter = array();
        $parameter['estimate'] = $estimate;
        $parameter['estimate_details'] = $estimate_details;
        /*$parameter['supplementary_estimates'] = $supplementary_estimates;
        $parameter['supplementary_estimate_details'] = $supplementary_estimate_details;*/
        $parameter['department'] = $department;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['job'] = $job;
        $parameter['insurance_company'] = $insurance_company;
        $parameter['services_count'] = $services_count;
        $parameter['parts_count'] = $parts_count;

        $pdf = PDF::loadView('estimates.print-estimate', $parameter);
        return $pdf->stream('estimate'.date("Y-m-d").'-'.$id.'.pdf');
    }

    public function download_estimate($id)
    {
        $estimate = Estimate::findOrFail($id);
        $estimate_details = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->selectRaw('estimate_details.*, items.type')
            ->where('estimate_details.estimate_id', '=', $id)->get();
        $services_count = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->where('estimate_details.estimate_id', '=', $id)
            ->where('items.type', '=', 'service')->count();
        $parts_count = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->where('estimate_details.estimate_id', '=', $id)
            ->where('items.type', '=', 'part')->count();
        /*$supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $id)->get();
        $supplementary_estimate_details = DB::table('supplementary_estimates')
            ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
            ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
            ->where('supplementary_estimates.estimate_id', '=', $id)->get();*/

        $department = Department::where('id', '=', $estimate->department)->firstOrFail();
        $customer = Customer::where('id', '=', $estimate->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $estimate->vehicle_id)->firstOrFail();
        $job = DB::table('jobs')->where('estimate_id', $estimate->id)->first();
        $insurance_company = InsuranceCompany::where('id', '=', $estimate->insurance_company)->first();

        $parameter = array();
        $parameter['estimate'] = $estimate;
        $parameter['estimate_details'] = $estimate_details;
        /*$parameter['supplementary_estimates'] = $supplementary_estimates;
        $parameter['supplementary_estimate_details'] = $supplementary_estimate_details;*/
        $parameter['department'] = $department;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['job'] = $job;
        $parameter['insurance_company'] = $insurance_company;
        $parameter['services_count'] = $services_count;
        $parameter['parts_count'] = $parts_count;

        $pdf = PDF::loadView('estimates.print-estimate', $parameter);
        return $pdf->download('estimate'.date("Y-m-d").'-'.$id.'.pdf');
    }

    public function download_estimate_insurance($id)
    {
        $estimate = Estimate::findOrFail($id);
        $estimate_details = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->selectRaw('estimate_details.*, items.type')
            ->where('estimate_details.estimate_id', '=', $id)->get();
        $services_count = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->where('estimate_details.estimate_id', '=', $id)
            ->where('items.type', '=', 'service')->count();
        $parts_count = DB::table('estimate_details')
            ->join('items', 'items.id', '=', 'estimate_details.item_id')
            ->where('estimate_details.estimate_id', '=', $id)
            ->where('items.type', '=', 'part')->count();

        $department = Department::where('id', '=', $estimate->department)->firstOrFail();
        $customer = Customer::where('id', '=', $estimate->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $estimate->vehicle_id)->firstOrFail();
        $job = DB::table('jobs')->where('estimate_id', $estimate->id)->first();
        $insurance_company = InsuranceCompany::where('id', '=', $estimate->insurance_company)->first();

        $parameter = array();
        $parameter['estimate'] = $estimate;
        $parameter['estimate_details'] = $estimate_details;
        $parameter['department'] = $department;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['job'] = $job;
        $parameter['insurance_company'] = $insurance_company;
        $parameter['services_count'] = $services_count;
        $parameter['parts_count'] = $parts_count;

        $pdf = PDF::loadView('estimates.print-estimate-insurance', $parameter);
        return $pdf->download('estimate-insurance-copy-'.date("Y-m-d").'-'.$id.'.pdf');
		
    }

}
