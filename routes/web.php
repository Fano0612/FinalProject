<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\PasscodeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// public
Route::get('', function () {
    return view('login');
});
Route::get('login', [User::class, 'login'])->name('login');
Route::POST('login', [User::class, 'loginacc'])->name('loginacc');
Route::get('/forgotpassword', function () {
    return view('forgotpassword');
})->name('lupapassword');
Route::get('logout', [User::class, 'logout'])->name('logout');


// pelanggan
Route::POST('register', [User::class, 'registeracc'])->name('registeracc');
Route::get('register', [User::class, 'register'])->name('register');
Route::get('/dashboardpelanggan', function () {
    return view('dashboardpelanggan');
})->name('dashboardpelanggan');


// Karyawan + General Manager Operasional
Route::get('/dashboardkaryawan', function () {
    return view('dashboardkaryawan');
})->name('dashboardkaryawan');
Route::get('/dashboardgeneralmanageroperasional', function () {
    return view('dashboardgeneralmanageroperasional');
})->name('dashboardgeneralmanageroperasional');
Route::POST('registerstaff', [User::class, 'registeraccstaff'])->name('registeraccstaff');
Route::get('registerstaff', [User::class, 'registerstaff'])->name('registerstaff');


Route::get('/password', function () {
    return view('password');
});
Route::post('/check-password', [PasscodeController::class, 'checkPassword'])->name('checkPassword');



