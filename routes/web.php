<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('employee')->group(function(){
//    if(Auth::check()){
//        return redirect('employee');
//    }
    Route::get('/login', [EmployeeController::class, "login"])->name('emp.login');
    Route::post('/login', [EmployeeController::class, "login_validate"])->name('emp.login_validate');

    Route::get('/manager', [EmployeeController::class, "manager_dashboard"])->name('emp.manager');
    //Route::get('/employee/', [EmployeeController::class, "employee_dashboard"])->name('emp.employee');

    Route::get('/approvalRequest/{id}', [EmployeeController::class, "send_approval_request"])->name('emp.approval_req');
    Route::post('/approvalRequest', [EmployeeController::class, "send_approval_request_processing"])->name('emp.approval_req_process');

    Route::get('/approveRequest/{id}', [EmployeeController::class, "holidays_approval_request"])->name('holidays.approval_req');
    Route::get('/cancelRequest/{id}', [EmployeeController::class, "holidays_cancel_request"])->name('holidays.cancel_req');


}); //End of employee prefix




