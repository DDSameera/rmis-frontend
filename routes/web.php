<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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


/*Authentication*/
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::get('login', [AuthController::class, 'index'])->name('auth.login');
});

Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('store', [AuthController::class, 'store'])->name('auth.store');

Route::post('authenticate', [AuthController::class, 'login'])->name('auth.authenticate');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

/*Dashboard*/
Route::group(['middleware' => ['auth.admin','verify.token']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('generate/chart', [DashboardController::class, 'generateChart'])->name('generate.chart');
});




