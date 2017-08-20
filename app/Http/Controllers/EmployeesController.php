<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Employee;
use App\EmployeeRole;
use DB;

class EmployeesController extends Controller
{
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
        $employees = DB::table('employees')
            ->join('employee_roles', 'employee_roles.id', '=', 'employees.role_id')
            ->selectRaw('employees.*, employees.id as employee_id, employee_roles.*')
            ->get();
        return view('settings.employees.employees', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = EmployeeRole::lists('role', 'id')->all();
        return view('settings.employees.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $employee = new Employee();
        $employee->name = $input['name'];
        $employee->role_id = $input['role_id'];
        $employee->rate = $input['rate'];
        $employee->ot_rate = $input['ot_rate'];
        $employee->double_ot_rate = $input['double_ot_rate'];
        $employee->other = $input['other'];
        $employee->save($request->all());

        return redirect('/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $role = DB::table('employee_roles')->where('id', '=', $employee->role_id)->first();
        return view('settings.employees.single-employee', compact('employee', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $roles = EmployeeRole::lists('role', 'id')->all();
        return view('settings.employees.edit', compact('employee', 'roles'));
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
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return redirect('employees');
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
