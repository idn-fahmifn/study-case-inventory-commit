<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\AdminMiddlware;

Route::get('/', function () {
    return view('welcome');
});


Route::view('templating','template');

Auth::routes();


// hanya bisa diakses oleh admin
Route::middleware(AdminMiddlware::class)->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('petugas', UserController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('barang', BarangController::class);
});

Route::get('dashboard-petugas', function(){
    return view('dashboard-petugas');
})->name('dashboard-petugas');
