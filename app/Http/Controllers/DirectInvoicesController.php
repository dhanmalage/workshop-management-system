<?php

namespace App\Http\Controllers;

use App\DirectInvoice;
use App\InvoiceType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests\DirectInvoiceRequest;
use App\DirectInvoiceDetail;
use App\Vehicle;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Redirect;

class DirectInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::lists('name', 'id')->all();
        $items = Item::lists('name', 'id')->all();
        $invoice_types = InvoiceType::lists('type', 'type')->all();
        return view('invoices.direct-invoices.create', compact('customers', 'items', 'invoice_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectInvoiceRequest $request)
    {
        $vat = DB::table('taxes')->where('tax_name', '=', 'VAT')->first();
        $nbt = DB::table('taxes')->where('tax_name', '=', 'NBT')->first();

        $user = Auth::user();

        $input = $request->all();

        $direct_invoice = new DirectInvoice();
        $direct_invoice->customer_id = $input['customer_id'];
        $direct_invoice->vehicle_id = $input['vehicle_id'];
        $direct_invoice->invoice_type = $input['invoice_type'];
        $direct_invoice->net_amount = $input['net_amount'];
        $direct_invoice->vat_value = $vat->tax_value;
        $direct_invoice->nbt_value = $nbt->tax_value;
        $direct_invoice->remarks = $input['remarks'];
        $direct_invoice->created_by = $user->id;

        $direct_invoice->save($request->all());

        $vat = DB::table('taxes')->where('tax_name', '=', 'VAT')->first();
        $nbt = DB::table('taxes')->where('tax_name', '=', 'NBT')->first();

        for ($i = 0; $i < count($input['item_id']); $i++) {
            $direct_invoice_detail = new DirectInvoiceDetail();
            $direct_invoice_detail->item_id = $input['item_id'][$i];
            $direct_invoice_detail->item_description = $input['item_description'][$i];
            $direct_invoice_detail->units = $input['units'][$i];
            $direct_invoice_detail->rate = $input['rate'][$i];
            $direct_invoice_detail->initial_amount = $input['amount'][$i];

            $item = DB::table('items')->where('id', '=', $input['item_id'][$i])->first();

            if ($item->vat == '1' && $item->nbt == '1') {

                $direct_invoice_detail->vat = $vat->tax_value;
                $direct_invoice_detail->nbt = $nbt->tax_value;

                $only_nbt = $nbt->tax_value / 100 * $input['amount'][$i];
                $direct_invoice_detail->nbt_value = $only_nbt;
                $nbt_pay = $only_nbt + $input['amount'][$i];

                $pay_vat = $vat->tax_value / 100 * $nbt_pay;
                $direct_invoice_detail->vat_value = $pay_vat;
                $direct_invoice_detail->pay_amount = $nbt_pay + $pay_vat;

            } elseif ($item->nbt == '1' && $item->nbt == null) {
                $direct_invoice_detail->vat = $vat->tax_value;
                $pay_vat = $vat->tax_value / 100 * $input['amount'][$i];
                $direct_invoice_detail->vat_value = $pay_vat;
                $direct_invoice_detail->pay_amount = $pay_vat + $input['amount'][$i];
            } elseif ($item->vat == null && $item->nbt == '1') {
                $direct_invoice_detail->nbt = $nbt->tax_value;
                $pay_nbt = $nbt->tax_value / 100 * $input['amount'][$i];
                $direct_invoice_detail->nbt_value = $pay_nbt;
                $direct_invoice_detail->pay_amount = $pay_nbt + $input['amount'][$i];
            } else {
                $direct_invoice_detail->vat_value = 0;
                $direct_invoice_detail->nbt_value = 0;
                $direct_invoice_detail->pay_amount = $input['amount'][$i];
            }

            $direct_invoice->direct_invoice_details()->save($direct_invoice_detail);
        }

        $vat_total = DB::table('direct_invoice_details')->where('direct_invoice_id', '=', $direct_invoice->id)->sum('vat_value');
        $nbt_total = DB::table('direct_invoice_details')->where('direct_invoice_id', '=', $direct_invoice->id)->sum('nbt_value');
        $total = DB::table('direct_invoice_details')->where('direct_invoice_id', '=', $direct_invoice->id)->sum('pay_amount');

        if ($direct_invoice) {

            DB::table('direct_invoices')->where('id', '=', $direct_invoice->id)->update(['vat_total' => $vat_total]);
            DB::table('direct_invoices')->where('id', '=', $direct_invoice->id)->update(['nbt_total' => $nbt_total]);
            DB::table('direct_invoices')->where('id', '=', $direct_invoice->id)->update(['total_pay' => $total]);
        }

        return redirect('direct_invoices/'.$direct_invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = DirectInvoice::findOrFail($id);
        // $invoice_details = DB::table('direct_invoice_details')->where('direct_invoice_id', '=', $invoice->id)->get();

        $invoice_details = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->selectRaw('direct_invoice_details.*, items.type')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)->get();

        $customer = Customer::where('id', '=', $invoice->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $invoice->vehicle_id)->firstOrFail();
        return view('invoices.direct-invoices.single-invoice', compact('invoice', 'invoice_details', 'customer', 'vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     *
     * Confirm before delete record
     */
    public function delete_confirm_direct_invoice($id)
    {
        $invoice = DirectInvoice::findOrFail($id);

        return view('invoices.direct-invoices.delete-confirm', compact('invoice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = DirectInvoice::findOrFail($id);
        $invoice->delete();

        return Redirect::route('invoices.index');
    }

    public function print_direct_invoice($id)
    {
        $invoice = DirectInvoice::findOrFail($id);
       // $invoice_details = DB::table('direct_invoice_details')->where('direct_invoice_id', '=', $invoice->id)->get();

        $invoice_details = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->selectRaw('direct_invoice_details.*, items.type')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)->get();

        $services_count = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)
            ->where('items.type', '=', 'service')->count();

        $parts_count = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)
            ->where('items.type', '=', 'part')->count();

        $customer = Customer::where('id', '=', $invoice->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $invoice->vehicle_id)->firstOrFail();

        $parameter = array();
        $parameter['invoice'] = $invoice;
        $parameter['invoice_details'] = $invoice_details;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['services_count'] = $services_count;
        $parameter['parts_count'] = $parts_count;

        $pdf = PDF::loadView('invoices.direct-invoices.print-invoice', $parameter);
        return $pdf->stream('direct-invoice'.$invoice->id.'.pdf');

    }

    public function download_direct_invoice($id)
    {
        $invoice = DirectInvoice::findOrFail($id);
       // $invoice_details = DB::table('direct_invoice_details')->where('direct_invoice_id', '=', $invoice->id)->get();

        $invoice_details = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->selectRaw('direct_invoice_details.*, items.type')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)->get();

        $services_count = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)
            ->where('items.type', '=', 'service')->count();

        $parts_count = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)
            ->where('items.type', '=', 'part')->count();

        $customer = Customer::where('id', '=', $invoice->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $invoice->vehicle_id)->firstOrFail();

        $parameter = array();
        $parameter['invoice'] = $invoice;
        $parameter['invoice_details'] = $invoice_details;
        $parameter['customer'] = $customer;
        $parameter['vehicle'] = $vehicle;
        $parameter['services_count'] = $services_count;
        $parameter['parts_count'] = $parts_count;

        $pdf = PDF::loadView('invoices.direct-invoices.print-invoice', $parameter);
        return $pdf->download('direct-invoice'.$invoice->id.'.pdf');

    }

    public function dot_print_direct_invoice($id)
    {
        $invoice = DirectInvoice::findOrFail($id);
       // $invoice_details = DB::table('direct_invoice_details')->where('direct_invoice_id', '=', $invoice->id)->get();

        $invoice_details = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->selectRaw('direct_invoice_details.*, items.type')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)->get();

        $services_count = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)
            ->where('items.type', '=', 'service')->count();

        $parts_count = DB::table('direct_invoice_details')
            ->join('items', 'items.id', '=', 'direct_invoice_details.item_id')
            ->where('direct_invoice_details.direct_invoice_id', '=', $id)
            ->where('items.type', '=', 'part')->count();

        $customer = Customer::where('id', '=', $invoice->customer_id)->firstOrFail();
        $vehicle = Vehicle::where('id', '=', $invoice->vehicle_id)->firstOrFail();
		$count = DB::table('direct_invoice_details')->where('direct_invoice_id', '=', $invoice->id)->count();

        return view('invoices.direct-invoices.dot-print-invoice', compact('invoice', 'invoice_details', 'customer', 'vehicle', 'count', 'services_count', 'parts_count'));

    }


}
