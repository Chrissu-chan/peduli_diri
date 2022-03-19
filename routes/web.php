<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerjalananController;

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

Route::get('/login',    [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register',[AuthController::class, 'register'])->name('register');
Route::get('logout',   [AuthController::class, 'logout'])->name('logout');
Route::post('login',   [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('qrcode/{id}', [PerjalananController::class, 'qrcode'])->name('qrcode');
    Route::get('generate/{id}', [PerjalananController::class, 'generate'])->name('generate');
    Route::get('/perjalanan/get', [PerjalananController::class, 'get'])->name('perjalanan.get');
    Route::resource('/perjalanan', PerjalananController::class);
});

// Route::group(['middleware' => 'auth:users'], function () {
//     Route::get('home', [HomeController::class, 'index'])->name('home');
// });
