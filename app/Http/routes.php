<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 *
 * Following Routes used to control access to reports module
 */
// only owners will have access to routes within reports
Entrust::routeNeedsRole('reports', 'owner', Redirect::to('/home'));
Entrust::routeNeedsRole('reports.est-vehicles', 'owner', Redirect::to('/home'));
Entrust::routeNeedsRole('reports.est-pending', 'owner', Redirect::to('/home'));
Entrust::routeNeedsRole('reports.jobs-open', 'owner', Redirect::to('/home'));
Entrust::routeNeedsRole('reports.jobs-complete', 'owner', Redirect::to('/home'));
Entrust::routeNeedsRole('reports.job-invoices', 'owner', Redirect::to('/home'));
Entrust::routeNeedsRole('reports.direct-invoices', 'owner', Redirect::to('/home'));


/*
 *
 * Dashboard Routes
 */

Route::get('/', ['middleware' => 'auth', function () {
    $completedEstimates = DB::table('estimates')->where('job_id', '<>', '', 'and')->count();
    $totalEstimates = DB::table('estimates')->count();
    $openEstimates = $totalEstimates - $completedEstimates;

    $completeJobs = DB::table('jobs')->where('status', 'complete')->count();
    $openJobs = DB::table('jobs')->where('status', 'open')->count();
    $doneJobs = DB::table('jobs')->where('status', 'job_done')->count();
    $totalJobs = DB::table('jobs')->count();

    return view('dashboard', compact('openEstimates', 'completedEstimates', 'totalEstimates', 'completeJobs', 'openJobs', 'doneJobs', 'totalJobs'));
}]);


Route::get('/home', ['middleware' => 'auth', function () {
    $completedEstimates = DB::table('estimates')->where('job_id', '<>', '', 'and')->count();
    $totalEstimates = DB::table('estimates')->count();
    $openEstimates = $totalEstimates - $completedEstimates;

    $completeJobs = DB::table('jobs')->where('status', 'complete')->count();
    $openJobs = DB::table('jobs')->where('status', 'open')->count();
    $doneJobs = DB::table('jobs')->where('status', 'job_done')->count();
    $totalJobs = DB::table('jobs')->count();

    return view('dashboard', compact('openEstimates', 'completedEstimates', 'totalEstimates', 'completeJobs', 'openJobs', 'doneJobs', 'totalJobs'));
}]);

/*
 *
 * Users Module Routes
 */
Route::resource('users', 'UsersController');
/*
Route::get('password-change', 'UsersController@passwordChange');
Route::post('password-update', 'UsersController@passwordUpdate');
*/

/*
 *
 * Estimate Create Ajax customer vehicle data call
 */
Route::get('/ajax-vehicle', function(){
    $customer_id = Input::get('cust_id');
    $vehicles = App\Vehicle::where('customer_id', '=', $customer_id)->get();
    return Response::json($vehicles);
});

/*
 *
 * Estimate Create Ajax item data call
 */
Route::get('/ajax-items', function(){
    $items = App\Item::all();
    return Response::json($items);
});

/*
 *
 * Estimate Create Ajax item data call
 */
Route::get('/ajax-item', function(){
    $item_id = Input::get('item_id');
    $item = App\Item::where('id', '=', $item_id)->get();
    return Response::json($item);
});

/*
 *
 *  Authentication Route
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/*
 *
 * Resource Routes for All Modules
 */
Route::resource('items', 'ItemsController');

Route::resource('estimates', 'EstimatesController');

Route::get('print_estimate/{id}', 'EstimatesController@print_estimate');
Route::get('download_estimate/{id}', 'EstimatesController@download_estimate');
Route::get('download_estimate_insurance/{id}', 'EstimatesController@download_estimate_insurance');

Route::resource('supplementary_estimates', 'SupplementaryEstimatesController');
Route::get('supplementary_estimates/create_supplementary/{id}', 'SupplementaryEstimatesController@create_supplementary');

Route::get('print_supplementary/{id}', 'SupplementaryEstimatesController@print_supplementary');
Route::get('download_supplementary/{id}', 'SupplementaryEstimatesController@download_supplementary');

Route::resource('customers', 'CustomersController');

Route::resource('vehicles', 'VehiclesController');

Route::resource('suppliers', 'SuppliersController');

Route::resource('orders', 'OrdersController');

Route::resource('taxes', 'TaxesController');


/*
 *
 * All Routes for Jobs Module
 */
Route::resource('jobs', 'JobsController');
Route::get('jobs/create_job/{id}', 'JobsController@create_job');
Route::get('jobs/job_done/{id}', 'JobsController@job_done');
Route::get('jobs/labour_complete/{id}', 'JobsController@labour_complete');
Route::get('jobs/consumption_complete/{id}', 'JobsController@consumption_complete');
Route::get('print_job/{id}', 'JobsController@print_job');
Route::get('download_job/{id}', 'JobsController@download_job');


/*
 *
 * All Routes for GRN Module
 */
Route::resource('grn', 'GrnController');
Route::get('grn/create_grn/{id}', 'GrnController@create_grn');
Route::get('/ajax-grn', function(){
    $supplier_id = Input::get('supplier_id');
    $items = DB::table('orders')
        ->join('order_details', 'order_details.order_id', '=', 'orders.id')
        ->join('items', 'order_details.item_id', '=', 'items.id')
        ->where('order_details.balance_quantity', '>', 0)
        ->where('orders.supplier_id', '=', $supplier_id)
        ->where('orders.order_status', '=', 'open')
        ->selectRaw('orders.*, order_details.*, order_details.balance_quantity as qty, order_details.id as order_detail_id, items.*')->get();
    return Response::json($items);
});

/*
 *
 * Route for settings main page
 */
Route::get('settings', 'SettingsController@index');

Route::resource('departments', 'DepartmentsController');

Route::resource('item_categories', 'ItemCategoriesController');

Route::resource('stakeholders', 'StakeholdersController');

Route::resource('estimate_types', 'EstimateTypesController');

Route::resource('stakeholders', 'StakeholdersController');

Route::resource('issue_notes', 'IssueNotesController');

Route::get('ajax_issue_note_job_items', function(){
    $job_id = Input::get('job_id');
    $job_items = DB::table('job_details')
        ->where('job_id', '=', $job_id)
        ->where('task_status', '=', 'open')->get();
    return Response::json($job_items);
});

Route::get('ajax_issue_note_job_items_qty', function(){
    $job_id = Input::get('job_id');
    $detail_id = Input::get('detail_id');
    $qty_req = DB::table('job_details')
        ->where('job_id', '=', $job_id)
        ->where('id', '=', $detail_id)->get();
    return Response::json($qty_req);
});

/*
 *
 * Job Invoices Routes
 */
Route::resource('invoices', 'InvoicesController');

Route::get('invoices/new_job_invoice/{id}', 'InvoicesController@new_job_invoice');
Route::post('invoices/save_invoice', 'InvoicesController@save_invoice');

Route::get('ajax-invoice-create', function(){
    $job_id = Input::get('job_id');
    $job_data = DB::table('jobs')
        ->where('jobs.id', '=', $job_id)
        ->join('estimates', 'estimates.id', '=', 'jobs.estimate_id')
        ->join('customers', 'customers.id', '=', 'estimates.customer_id')
        ->join('vehicles', 'vehicles.id', '=', 'estimates.vehicle_id')
        ->selectRaw('jobs.*, jobs.id as job_id, estimates.*, estimates.id as est_id, customers.*, vehicles.*')
        ->orderBy('jobs.id', 'desc')->get();
    return Response::json($job_data);
});

Route::get('print_invoice/{id}', 'InvoicesController@print_invoice');
Route::get('download_invoice/{id}', 'InvoicesController@download_invoice');
Route::get('dot_print_invoice/{id}', 'InvoicesController@dot_print_invoice');

/*
 *
 * Direct Invoices Routes
 */
Route::resource('direct_invoices', 'DirectInvoicesController');
Route::get('print_direct_invoice/{id}', 'DirectInvoicesController@print_direct_invoice');
Route::get('download_direct_invoice/{id}', 'DirectInvoicesController@download_direct_invoice');
Route::get('dot_print_direct_invoice/{id}', 'DirectInvoicesController@dot_print_direct_invoice');
Route::get('delete_confirm_direct_invoice/{id}', 'DirectInvoicesController@delete_confirm_direct_invoice');

/*
 *
 * Reports Module Routes
 */

Route::get('reports', 'ReportsController@index');

Route::get('reports.est-vehicles', 'ReportsController@est_vehicles');
Route::post('reports.est-vehicles', 'ReportsController@est_vehicles');
Route::get('reports.download_est-vehicles', 'ReportsController@pdf_est_vehicles');
Route::get('reports.download_est-vehicles/{date1}/{date2}', 'ReportsController@pdf_est_vehicles');

Route::get('reports.est-pending', 'ReportsController@est_pending');
Route::post('reports.est-pending', 'ReportsController@est_pending');
Route::get('reports.download_est-pending', 'ReportsController@pdf_est_pending');
Route::get('reports.download_est-pending/{date1}/{date2}', 'ReportsController@pdf_est_pending');

Route::get('reports.jobs-open', 'ReportsController@jobs_open');
Route::post('reports.jobs-open', 'ReportsController@jobs_open');
Route::get('reports.download_jobs-open', 'ReportsController@pdf_jobs_open');
Route::get('reports.download_jobs-open/{date1}/{date2}', 'ReportsController@pdf_jobs_open');

Route::get('reports.jobs-complete', 'ReportsController@jobs_complete');
Route::post('reports.jobs-complete', 'ReportsController@jobs_complete');
Route::get('reports.download_jobs-complete', 'ReportsController@pdf_jobs_complete');
Route::get('reports.download_jobs-complete/{date1}/{date2}', 'ReportsController@pdf_jobs_complete');

Route::get('reports.job-invoices', 'ReportsController@job_invoices');
Route::post('reports.job-invoices', 'ReportsController@job_invoices');
Route::get('reports.download_job_invoices', 'ReportsController@pdf_job_invoices');
Route::get('reports.download_job_invoices/{date1}/{date2}', 'ReportsController@pdf_job_invoices');

Route::get('reports.direct-invoices', 'ReportsController@direct_invoices');
Route::post('reports.direct-invoices', 'ReportsController@direct_invoices');
Route::get('reports.download_direct_invoices', 'ReportsController@pdf_direct_invoices');
Route::get('reports.download_direct_invoices/{date1}/{date2}', 'ReportsController@pdf_direct_invoices');

Route::resource('employee_roles', 'EmployeeRolesController');

Route::resource('employees', 'EmployeesController');

Route::resource('labours', 'LaboursController');

Route::resource('insurance_companies', 'InsuranceCompaniesController');

Route::resource('consumptions', 'ConsumptionsController');

Route::resource('invoice_types', 'InvoiceTypesController');

Route::post('quick-add-customers','CustomersController@quick_add_customer');
Route::post('quick-add-item','ItemsController@quick_add_item');
Route::post('direct-invoice-quick-add-customers','CustomersController@direct_invoice_quick_add_customer');


/*
 *
 * Dashboard Routes
 */
Route::resource('dashboard', 'DashboardController');
Route::post('system-status', 'DashboardController@system_status');

/*
Route::get('system-status', function(){

    // memory usage
    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage = $mem[2]/$mem[1]*100;

    // cpu usage
    $load = sys_getloadavg();

    return Response::json(['memory'=>$memory_usage, 'cpu'=>$load]);
});
*/

