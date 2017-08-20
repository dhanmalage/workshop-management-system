<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\InsuranceCompany;
use App\Http\Requests\InsuranceCompanyRequest;
use Illuminate\Support\Facades\Auth;

class InsuranceCompaniesController extends Controller
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
        $insurance_companies = InsuranceCompany::all();
        return view('settings.insurance_companies.insurance_companies', compact('insurance_companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.insurance_companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsuranceCompanyRequest $request)
    {
        $user = Auth::user();

        $input = $request->all();
        $company = new InsuranceCompany();
        $company->name = $input['name'];
        $company->address = $input['address'];
        $company->telephone = $input['telephone'];
        $company->email = $input['email'];
        $company->fax = $input['fax'];
        $company->website = $input['website'];
        $company->contact_person = $input['contact_person'];
        $company->vat_no = $input['vat_no'];
        $company->created_by = $user->id;
        $company->save($request->all());

        return redirect('/insurance_companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insurance_company = InsuranceCompany::findOrFail($id);
        return view('settings.insurance_companies.single-insurance_company', compact('insurance_company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insurance_company = InsuranceCompany::findOrFail($id);
        return view('settings.insurance_companies.edit', compact('insurance_company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsuranceCompanyRequest $request, $id)
    {
        $insurance_company = InsuranceCompany::findOrFail($id);
        $insurance_company->update($request->all());
        return redirect('insurance_companies');
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
