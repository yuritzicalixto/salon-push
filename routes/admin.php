<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StylistController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.dashboard');
})->middleware('can:access_dashboard')
->name('dashboard');


Route::resource('users', UserController::class)
->middleware('can:users.manage'); //users.manage

Route::resource('products', ProductController::class)
->middleware('can:products.manage');

Route::resource('services', ServiceController::class)
->middleware('can:services.manage');

Route::resource('stylists', StylistController::class)
->middleware('can:stylists.manage');

// APARTADOS — Acciones de gestión
Route::post('reservations/{reservation}/complete', [ReservationController::class, 'markAsCompleted'])
    ->middleware('can:reservations.manage')
    ->name('reservations.complete');

Route::post('reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])
    ->middleware('can:reservations.manage')
    ->name('reservations.cancel');

Route::post('reservations/expire-all', [ReservationController::class, 'expireAll'])
    ->middleware('can:reservations.manage')
    ->name('reservations.expire-all');

// APARTADOS
Route::resource('reservations', ReservationController::class)
    ->middleware('can:reservations.manage');
