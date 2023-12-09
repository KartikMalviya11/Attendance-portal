<?php

use App\Http\Controllers\attendController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\forgotController;
use App\Http\Controllers\hrController;
use App\Http\Controllers\leavesController;
use Illuminate\Support\Facades\Route;

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

// Route::resource('student',StudentController::class);
// Route::get('/',function(){
//     return view
// })
// Route::get('/',function(){
//     return view('home');
// });

 

Route::get('/dashboard', function () {
    return view('employee.employee_dashboard');
});
Route::post("/emp/register",[employeeController::class,"store"])->name('employee.register');
// Route::post('/register', [employeeController::class, "store"]);
// =========================HR Routes===================================//


Route::get('/hr-login', function () {
    return view("HR.login");
});

Route::post("/hr/register", [hrController::class, 'store']);
Route::post("/hr/login", [hrController::class, 'login']);
Route::get("/hr/logout", [hrController::class, 'logout']);
Route::middleware(['AuthHrLogin'])->group(function () {
    Route::get('/hr/dashboard', [hrController::class, 'showDashboard']);
    Route::get('/employee/details', [hrController::class, 'showEmployeeDetails']);
    Route::get('/pending/leaves', [hrController::class, 'showPendingLeaves']);
    // =================Attendance Approve=====================//
    Route::get('/show/employee/eod', [hrController::class, 'showEmployeeEod']);
    Route::post('/approve', [hrController::class, 'approve']);
    Route::get('/approve/eod/{id}', [hrController::class, 'approveEod']);
    // ===========================Apply For leave =======================//
    Route::get('/approved/{id}', [leavesController::class, 'approvedLeave']);
    Route::get('/rejected/{id}', [leavesController::class, 'rejectedLeave']);
});
// =========================Employee Routes===================================//

Route::get('/', [employeeController::class, 'showLogin']);
Route::get('/reset', [forgotController::class, 'showreset']);
Route::post('/forgot', [forgotController::class, 'sendHr']);
Route::post('/verify', [forgotController::class, 'verify']);
Route::post('/reset', [forgotController::class, 'reset']);

 
Route::get('/forgot', function () {
    return view('employee.employee_forgot');
}); 
Route::post("/login", [employeeController::class, 'login']);
Route::middleware(['AuthLogin'])->group(function () {
    // =================Attendance Mark=====================//
    Route::post('/eod', [attendController::class, 'markEod']);
    Route::post('/miss/eod', [attendController::class, 'markMissEod']);
    Route::get('/employee/dashboard', [employeeController::class, 'index']);
    Route::post('/mark', [attendController::class, 'store']);
    Route::get("/logout/employee", [employeeController::class, "logout"]);
    Route::get('/get-report/{id}', [attendController::class, 'show']);
    Route::get('/getmiss/{id}', [attendController::class, 'showmiss']);
    Route::get('/employee/profile', function () {
        return view("employee.employee_profile");
    });
    Route::get("/get-attendance-data", [attendController::class, 'index']);
    Route::get('/employee/tables', function () {
        return view("employee.employee_table");
    });

    // ===========================Apply For leave =======================//

    Route::get("/my/leave/status", [leavesController::class, 'showLeaveStatusPage']);

    Route::post("/apply", [leavesController::class, 'apply']);
});
