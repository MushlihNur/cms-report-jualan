<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/dashboard/users', [UserController::class, 'index'])->name('admin.dashboard.users');
    Route::post('/admin/dashboard/users', [UserController::class, 'store']);
    Route::put('/admin/dashboard/users', [UserController::class, 'update']);
    Route::delete('/admin/dashboard/users', [UserController::class, 'destroy']);
    Route::get('/admin/dashboard/users/export', [UserController::class, 'export']);

    Route::get('/admin/dashboard/sales', [SalesController::class, 'index'])->name('admin.dashboard.sales');
    Route::post('/admin/dashboard/sales', [SalesController::class, 'store']);
    Route::put('/admin/dashboard/sales', [SalesController::class, 'update']);
    Route::delete('/admin/dashboard/sales', [SalesController::class, 'destroy']);
    Route::get('/admin/dashboard/sales/export', [SalesController::class, 'export']);
});
