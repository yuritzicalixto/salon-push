<?php
// routes/stylist.php

use App\Http\Controllers\Stylist\AppointmentController;
use App\Http\Controllers\Stylist\ClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.dashboard');
})->middleware('can:access_dashboard')
->name('dashboard');


// =====================================================
// MIS CITAS (vista del estilista)
// =====================================================
Route::get('/mis-citas', [AppointmentController::class, 'index'])
    ->middleware('can:stylist.appointments.view')
    ->name('appointments.index');


// =====================================================
// MIS CLIENTES
// =====================================================
Route::get('/mis-clientes', [ClientController::class, 'index'])
    ->middleware('can:stylist.clients.view')
    ->name('clients.index');
