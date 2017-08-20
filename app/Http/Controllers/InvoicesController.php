<?php

namespace App\Http\Controllers;

use App\DirectInvoice;
use App\Estimate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Invoice;
use DB;
use App\Job;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\Department;
use App\Vehicle;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\InvoiceDetail;
use Input;


class InvoicesController extends Controller
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
        $invoices = Invoice::orderBy('id','ASC')->get();
        $direct_invoices = DB::table('direct_invoices')
            ->join('customers', 'customers.id', '=', 'direct_invoices.customer_id')
            ->join('vehicles', 'vehicles.id', '=', 'direct_invoices.vehicle_id')
            ->selectRaw('direct_invoices.*, direct_invoices.id as din_id, direct_invoices.created_at as din_date, customers.*, customers.id as c_id, customers.name as cname, vehicles.*')
            ->orderBy('direct_invoices.id','ASC')->get();

        return view('invoices.invoices', compact('invoices', 'direct_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::where('status', 'job_done')->orderBy('id')->lists('id', 'id')->all();
        return view('invoices.create', compact('jobs'));
    }

    /**
     * Middle step before creating the job invoice
     *
     * post job id
     */
    public function new_job_invoice($id)
    {
        //$job_id = Input::get('job_id');
        $job_id = $id;
        $vat = DB::table('taxes')->where('tax_name', '=', 'VAT')->first();
        $nbt = DB::table('taxes')->where('tax_name', '=', 'NBT')->first();
        $job = DB::table('jobs')->where('id', $job_id)->first();
        $job_details = DB::table('job_details')->where('job_id', '=', $job_id)->get();
        $estimate = DB::table('estimates')->where('id', $job->estimate_id)->first();
        $insurance_company = DB::table('insurance_companies')->where('id', $estimate->insurance_company)->first();
        $customer = DB::table('customers')->where('id', $estimate->customer_id)->first();
        $vehicle = DB::table('vehicles')->where('id', $estimate->vehicle_id)->first();
        if($job->status == 'job_done'){
            return view('invoices.new-job-invoice', compact('vat', 'nbt', 'job', 'job_details', 'estimate', 'insurance_company', 'customer', 'vehicle'));
        }else{
            return view('invalid');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_invoice(InvoiceRequest $request)
    {


        $vat = DB::table('taxes')->where('tax_name', '=', 'VAT')->first();
        $nbt = DB::table('taxes')->where('tax_name', '=', 'NBT')->first();

        $user = Auth::user();

        $input = $request->all();

        $job = DB::table('jobs')->where('id', $input['job_id'])->first();
        //$job_details = DB::table('job_details')->where('job_id', '=', $input['job_id'])->get();
        $estimate = DB::table('estimates')->where('id', $job->estimate_id)->first();
        $insurance_company = DB::table('insurance_companies')->where('id', $estimate->insurance_company)->first();
        $customer = DB::table('customers')->where('id', $estimate->customer_id)->first();
        $vehicle = DB::table('vehicles')->where('id', $estimate->vehicle_id)->first();
        $invoice = new Invoice();
        $invoice->job_id = $input['job_id'];
        $invoice->insurance_pay = null;
        $invoice->customer_pay = null;
        $invoice->total = $job->grand_total;
        $invoice->vat_value = $vat->tax_value;
        $invoice->nbt_value = $nbt->tax_value;
        $invoice->remark = null;
        $invoice->customer_name = $customer->name;
        $invoice->customer_address = $customer->address1 .', '. $customer->address2 .', '. $customer->city;
        $invoice->customer_telephone = $customer->telephone;
        $invoice->customer_mobile = $customer->mobile;
        $invoice->customer_fax = $customer->fax;
        $invoice->customer_email = $customer->email;
        $invoice->insurance_company = $insurance_company->name;
        $invoice->insurance_address = $insurance_company->address;
        $invoice->insurance_vat_no = $insurance_company->vat_no;
        $invoice->vehicle_reg = $vehicle->reg_no;
        $invoice->vehicle_make = $vehicle->make;
        $invoice->vehicle_model = $vehicle->model;
        $invoice->vehicle_chasis = $vehicle->chasis_no;
        $invoice->vehicle_mileage = $estimate->mileage_in;
        $invoice->created_by = $user->id;

        $invoice->save($request->all());

        for($i=0;$i<count($input['job_detail_id']);$i++)
        {

            $invoice_detail = new InvoiceDetail();

            $job_detail = DB::table('job_details')->where('id', '=', $input['job_detail_id'][$i])->first();

            $invoice_detail->item_id = $input['item_id'][$i];
            $invoice_detail->item_description = $job_detail->item_description;
            $invoice_detail->units = $job_detail->units;
            $invoice_detail->rate = $job_detail->rate;
            $invoice_detail->initial_amount = $job_detail->initial_amount;
            $invoice_detail->approved_amount = $job_detail->approved_amount;

            $nbt_check = $input['nbt_check'][$i];
            $vat_check = $input['vat_check'][$i];

            if($nbt_check == 1 && $vat_check == 1){
                $invoice_detail->nbt = $nbt->tax_value;
                $nbt_apply = $job_detail->approved_amount + ($job_detail->approved_amount * $nbt->tax_value / 100);
                $invoice_detail->nbt_value = $job_detail->approved_amount * $nbt->tax_value / 100;
                $invoice_detail->vat = $vat->tax_value;
                $vat_apply = $nbt_apply + ($nbt_apply * $vat->tax_value / 100);
                $invoice_detail->vat_value = $nbt_apply * $vat->tax_value / 100;
                $invoice_detail->pay_amount = $vat_apply;
            }

            if($nbt_check == 1 && $vat_check == 0){
                $invoice_detail->nbt = $nbt->tax_value;
                $nbt_apply = $job_detail->approved_amount + ($job_detail->approved_amount * $nbt->tax_value / 100);
                $invoice_detail->nbt_value = $job_detail->approved_amount * $nbt->tax_value / 100;
                $invoice_detail->vat = null;
                $invoice_detail->vat_value = null;
                $invoice_detail->pay_amount = $nbt_apply;
            }

            if($nbt_check == 0 && $vat_check == 1){
                $invoice_detail->nbt = null;
                $invoice_detail->nbt_value = null;
                $invoice_detail->vat = $vat->tax_value;
                $vat_apply = $job_detail->approved_amount + ($job_detail->approved_amount * $vat->tax_value / 100);
                $invoice_detail->vat_value = $job_detail->approved_amount * $vat->tax_value / 100;
                $invoice_detail->pay_amount = $vat_apply;
            }

            if($nbt_check == 0 && $vat_check == 0){
                $invoice_detail->nbt = null;
                $invoice_detail->nbt_value = null;
                $invoice_detail->vat = null;
                $invoice_detail->vat_value = null;
                $invoice_detail->pay_amount = $job_detail->approved_amount;
            }

            $invoice_detail->detail_type = 1;

            $invoice->invoice_details()->save($invoice_detail);

        }


        $total = DB::table('invoice_details')->where('invoice_id', '=', $invoice->id)->sum('pay_amount');
        $vat_total = DB::table('invoice_details')->where('invoice_id', '=', $invoice->id)->sum('vat_value');
        $nbt_total = DB::table('invoice_details')->where('invoice_id', '=', $invoice->id)->sum('nbt_value');

        if($invoice){
            DB::table('invoices')->where('id', '=', $invoice->id)->update(['total_pay' => $total]);
            DB::table('invoices')->where('id', '=', $invoice->id)->update(['vat_total' => $vat_total]);
            DB::table('invoices')->where('id', '=', $invoice->id)->update(['nbt_total' => $nbt_total]);
            DB::table('jobs')->where('id', $input['job_id'])->update(['status' => 'complete']);
        }

        return redirect('invoices/'.$invoice->id);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {

        $vat = DB::table('taxes')->where('tax_name', '=', 'VAT')->first();
        $nbt = DB::table('taxes')->where('tax_name', '=', 'NBT')->first();

        $user = Auth::user();

        $input = $request->all();

        $job = DB::table('jobs')->where('id', $input['job_id'])->first();
        $estimate = DB::table('estimates')->where('id', $job->estimate_id)->first();
        $insurance_company = DB::table('insurance_companies')->where('id', $estimate->insurance_company)->first();
        $customer = DB::table('customers')->where('id', $estimate->customer_id)->first();
        $vehicle = DB::table('vehicles')->where('id', $estimate->vehicle_id)->first();
        $invoice = new Invoice();
        $invoice->job_id = $input['job_id'];
        $invoice->insurance_pay = $input['insurance_pay'];
        $invoice->customer_pay = $input['customer_pay'];
        $invoice->total = $input['job_total'];
        $invoice->vat_value = $vat->tax_value;
        $invoice->nbt_value = $nbt->tax_value;
        $invoice->remark = $input['remark'];
        $invoice->customer_name = $customer->name;
        $invoice->customer_address = $customer->address1 .', '. $customer->address2 .', '. $customer->city;
        $invoice->customer_telephone = $customer->telephone;
        $invoice->customer_mobile = $customer->mobile;
        $invoice->customer_fax = $customer->fax;
        $invoice->customer_email = $customer->email;
        $invoice->insurance_company = $insurance_company->name;
        $invoice->insurance_address = $insurance_company->address;
        $invoice->insurance_vat_no = $insurance_company->vat_no;
        $invoice->vehicle_reg = $vehicle->reg_no;
        $invoice->vehicle_make = $vehicle->make;
        $invoice->vehicle_model = $vehicle->model;
        $invoice->vehicle_chasis = $vehicle->chasis_no;
        $invoice->vehicle_mileage = $estimate->mileage_in;
        $invoice->created_by = $user->id;

        $invoice->save($request->all());

        $estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $estimate->id)->get();

        foreach($estimate_details as $detail)
        {
            $invoice_detail = new InvoiceDetail();
            $invoice_detail->item_id = $detail->item_id;
            $invoice_detail->item_description = $detail->item_description;
            $invoice_detail->units = $detail->units;
            $invoice_detail->rate = $detail->rate;
            $invoice_detail->initial_amount = $detail->initial_amount;
            $invoice_detail->approved_amount = $detail->approved_amount;
            $invoice_detail->detail_type = 1;

            $item = DB::table('items')->where('id', '=', $detail->item_id)->first();

            if($item->vat == '1' && $item->nbt == '1'){
				 
                $invoice_detail->vat = $vat->tax_value;
                $invoice_detail->nbt = $nbt->tax_value;	
				
                $only_nbt = $nbt->tax_value / 100 * $detail->approved_amount;
				$invoice_detail->nbt_value = $only_nbt;				
                $nbt_pay = $only_nbt + $detail->approved_amount;
				
                $pay_vat = $vat->tax_value / 100 * $nbt_pay;				
				$invoice_detail->vat_value = $pay_vat;
                $invoice_detail->pay_amount = $nbt_pay + $pay_vat;
				
            }elseif($item->vat == '1' && $item->nbt == null){
                $invoice_detail->vat = $vat->tax_value;
                $pay_vat = $vat->tax_value / 100 * $detail->approved_amount;
				$invoice_detail->vat_value = $pay_vat;
                $invoice_detail->pay_amount = $pay_vat + $detail->approved_amount;
            }elseif($item->vat == null && $item->nbt == '1'){
                $invoice_detail->nbt = $nbt->tax_value;
                $pay_nbt = $nbt->tax_value / 100 * $detail->approved_amount;
				$invoice_detail->nbt_value = $pay_nbt;
                $invoice_detail->pay_amount = $pay_nbt + $detail->approved_amount;
            }else{
				$invoice_detail->vat_value = 0;
				$invoice_detail->nbt_value = 0;
                $invoice_detail->pay_amount = $detail->approved_amount;
            }

            $invoice->invoice_details()->save($invoice_detail);
        }

        $supplementary_estimate_details = DB::table('supplementary_estimate_details')->where('estimate_id', '=', $estimate->id)->get();

        foreach($supplementary_estimate_details as $sup_detail)
        {
            $invoice_detail_sup = new InvoiceDetail();
            $invoice_detail_sup->item_id = $sup_detail->item_id;
            $invoice_detail_sup->item_description = $sup_detail->item_description;
            $invoice_detail_sup->units = $sup_detail->units;
            $invoice_detail_sup->rate = $sup_detail->rate;
            $invoice_detail_sup->initial_amount = $sup_detail->initial_amount;
            $invoice_detail_sup->approved_amount = $sup_detail->initial_amount;
            $invoice_detail_sup->detail_type = 2;

            $item = DB::table('items')->where('id', '=', $sup_detail->item_id)->first();

            if($item->vat == '1' && $item->nbt == '1'){
                $invoice_detail_sup->vat = $vat->tax_value;
                $invoice_detail_sup->nbt = $nbt->tax_value;
				
                $only_nbt = $nbt->tax_value / 100 * $sup_detail->initial_amount;
				$invoice_detail_sup->nbt_value = $only_nbt;
                $nbt_pay = $only_nbt + $sup_detail->initial_amount;
				
                $pay_vat = $vat->tax_value / 100 * $nbt_pay;
				$invoice_detail_sup->vat_value = $pay_vat;
                $invoice_detail_sup->pay_amount = $nbt_pay + $pay_vat;
				
            }elseif($item->vat == '1' && $item->nbt == null){
                $invoice_detail_sup->vat = $vat->tax_value;
                $pay_vat = $vat->tax_value / 100 * $sup_detail->initial_amount;
				$invoice_detail_sup->vat_value = $pay_vat;
                $invoice_detail_sup->pay_amount = $pay_vat + $sup_detail->initial_amount;
            }elseif($item->vat == null && $item->nbt == '1'){
                $invoice_detail_sup->nbt = $nbt->tax_value;
                $pay_nbt = $nbt->tax_value / 100 * $sup_detail->initial_amount;
				$invoice_detail_sup->nbt_value = $pay_nbt;
                $invoice_detail_sup->pay_amount = $pay_nbt + $sup_detail->initial_amount;
            }else{
				$invoice_detail_sup->vat_value = 0;
				$invoice_detail_sup->nbt_value = 0;
                $invoice_detail_sup->pay_amount = $sup_detail->initial_amount;
            }

            $invoice->invoice_details()->save($invoice_detail_sup);
        }
		
		$total = DB::table('invoice_details')->where('invoice_id', '=', $invoice->id)->sum('pay_amount');
		$vat_total = DB::table('invoice_details')->where('invoice_id', '=', $invoice->id)->sum('vat_value');
		$nbt_total = DB::table('invoice_details')->where('invoice_id', '=', $invoice->id)->sum('nbt_value');

        if($invoice){
            DB::table('invoices')->where('id', '=', $invoice->id)->update(['total_pay' => $total]);
            DB::table('invoices')->where('id', '=', $invoice->id)->update(['vat_total' => $vat_total]);
            DB::table('invoices')->where('id', '=', $invoice->id)->update(['nbt_total' => $nbt_total]);			
            DB::table('jobs')->where('id', $input['job_id'])->update(['status' => 'complete']);
        }

        return redirect('invoices/'.$invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
       // $invoice_details = DB::table('invoice_details')->where('invoice_id', '=', $id)->get();

        $invoice_details = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->selectRaw('invoice_details.*, items.type')
            ->where('invoice_details.invoice_id', '=', $id)->get();

        $job = Job::findOrFail($invoice->job_id);
        $estimate = Estimate::findOrFail($job->estimate_id);
        /*$estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $estimate->id)->get();*/
        $department = Department::where('id', '=', $estimate->department)->firstOrFail();
        $customer = Customer::where('id', '=', $estimate->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $estimate->vehicle_id)->firstOrFail();
        /*$supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $job->estimate_id)->get();
        $supplementary_estimate_details = DB::table('supplementary_estimates')
            ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
            ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
            ->where('supplementary_estimates.estimate_id', '=', $job->estimate_id)->get();*/

        return view('invoices.single-invoice', compact('invoice', 'invoice_details', 'job', 'estimate', 'estimate_details', 'department', 'customer', 'vehicle', 'supplementary_estimates', 'supplementary_estimate_details'));
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

    public function print_invoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        //$invoice_details = DB::table('invoice_details')->where('invoice_id', '=', $id)->get();

        $invoice_details = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->selectRaw('invoice_details.*, items.type')
            ->where('invoice_details.invoice_id', '=', $id)->get();

        $services_count = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->where('invoice_details.invoice_id', '=', $id)
            ->where('items.type', '=', 'service')->count();

        $parts_count = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->where('invoice_details.invoice_id', '=', $id)
            ->where('items.type', '=', 'part')->count();

        $job = Job::findOrFail($invoice->job_id);
        $estimate = Estimate::findOrFail($job->estimate_id);
        /*$estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $estimate->id)->get();*/
        $department = Department::where('id', '=', $estimate->department)->firstOrFail();
        $customer = Customer::where('id', '=', $estimate->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $estimate->vehicle_id)->firstOrFail();
        /*$supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $job->estimate_id)->get();
        $supplementary_estimate_details = DB::table('supplementary_estimates')
            ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
            ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
            ->where('supplementary_estimates.estimate_id', '=', $job->estimate_id)->get();*/

        $parameter = array();
        $parameter['invoice'] = $invoice;
        $parameter['invoice_details'] = $invoice_details;
        $parameter['job'] = $job;
        $parameter['estimate'] = $estimate;
        //$parameter['estimate_details'] = $estimate_details;
        $parameter['department'] = $department;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['services_count'] = $services_count;
        $parameter['parts_count'] = $parts_count;
        //$parameter['supplementary_estimates'] = $supplementary_estimates;
        //$parameter['supplementary_estimate_details'] = $supplementary_estimate_details;

        $pdf = PDF::loadView('invoices.print-invoice', $parameter);
        return $pdf->stream('invoice.pdf');

    }

    public function download_invoice($id)
    {
        $invoice = Invoice::findOrFail($id);
       // $invoice_details = DB::table('invoice_details')->where('invoice_id', '=', $id)->get();

        $invoice_details = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->selectRaw('invoice_details.*, items.type')
            ->where('invoice_details.invoice_id', '=', $id)->get();

        $services_count = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->where('invoice_details.invoice_id', '=', $id)
            ->where('items.type', '=', 'service')->count();

        $parts_count = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->where('invoice_details.invoice_id', '=', $id)
            ->where('items.type', '=', 'part')->count();

        $job = Job::findOrFail($invoice->job_id);
        $estimate = Estimate::findOrFail($job->estimate_id);
        //$estimate_details = DB::table('estimate_details')->where('estimate_id', '=', $estimate->id)->get();
        $department = Department::where('id', '=', $estimate->department)->firstOrFail();
        $customer = Customer::where('id', '=', $estimate->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $estimate->vehicle_id)->firstOrFail();
        /*$supplementary_estimates = DB::table('supplementary_estimates')->where('estimate_id', '=', $job->estimate_id)->get();
        $supplementary_estimate_details = DB::table('supplementary_estimates')
            ->join('supplementary_estimate_details', 'supplementary_estimate_details.supplementary_estimate_id', '=', 'supplementary_estimates.id')
            ->selectRaw('supplementary_estimates.*, supplementary_estimates.id as se_id, supplementary_estimate_details.*')
            ->where('supplementary_estimates.estimate_id', '=', $job->estimate_id)->get();*/

        $parameter = array();
        $parameter['invoice'] = $invoice;
        $parameter['invoice_details'] = $invoice_details;
        $parameter['job'] = $job;
        $parameter['estimate'] = $estimate;
        //$parameter['estimate_details'] = $estimate_details;
        $parameter['department'] = $department;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['services_count'] = $services_count;
        $parameter['parts_count'] = $parts_count;
        //$parameter['supplementary_estimates'] = $supplementary_estimates;
        //$parameter['supplementary_estimate_details'] = $supplementary_estimate_details;

        $pdf = PDF::loadView('invoices.print-invoice', $parameter);
        return $pdf->download('invoice.pdf');

    }

    public function dot_print_invoice($id)
    {
        $invoice = Invoice::findOrFail($id);
       // $invoice_details = DB::table('invoice_details')->where('invoice_id', '=', $id)->get();

        $invoice_details = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->selectRaw('invoice_details.*, items.type')
            ->where('invoice_details.invoice_id', '=', $id)->get();

        $services_count = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->where('invoice_details.invoice_id', '=', $id)
            ->where('items.type', '=', 'service')->count();

        $parts_count = DB::table('invoice_details')
            ->join('items', 'items.id', '=', 'invoice_details.item_id')
            ->where('invoice_details.invoice_id', '=', $id)
            ->where('items.type', '=', 'part')->count();

        $job = Job::findOrFail($invoice->job_id);
        $estimate = Estimate::findOrFail($job->estimate_id);

        $department = Department::where('id', '=', $estimate->department)->firstOrFail();
        $customer = Customer::where('id', '=', $estimate->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $estimate->vehicle_id)->firstOrFail();
		$count = DB::table('invoice_details')->where('invoice_id', '=', $id)->count();

        return view('invoices.dot-print-invoice', compact('invoice', 'invoice_details', 'job', 'estimate', 'estimate_details', 'department', 'customer', 'vehicle', 'supplementary_estimates', 'supplementary_estimate_details', 'count', 'services_count', 'parts_count'));

    }


}
