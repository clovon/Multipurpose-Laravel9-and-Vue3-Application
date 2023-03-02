<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\AppointmentStatusController;

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

// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/api/users', [UserController::class, 'index']);
Route::post('/api/users', [UserController::class, 'store']);
Route::get('/api/users/search', [UserController::class, 'search']);
Route::patch('/api/users/{user}/change-role', [UserController::class, 'changeRole']);
Route::put('/api/users/{user}', [UserController::class, 'update']);
Route::delete('/api/users/{user}', [UserController::class, 'destory']);
Route::delete('/api/users', [UserController::class, 'bulkDelete']);

Route::get('/api/appointment-status', [AppointmentStatusController::class, 'getStatusWithCount']);
Route::get('/api/appointments', [AppointmentController::class, 'index']);
Route::post('/api/appointments/create', [AppointmentController::class, 'store']);
Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
