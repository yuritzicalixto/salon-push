<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('sitio.index');
});

Route::group(['prefix' => 'sitio'], function (){

    Route::get( '/index', [App\Http\Controllers\FrontEndController::class, 'index'])->name('sitio.index');
    Route::get( '/galeria', [App\Http\Controllers\FrontEndController::class, 'galeria'])->name('sitio.galeria');
    Route::get( '/nosotros', [App\Http\Controllers\FrontEndController::class, 'nosotros'])->name('sitio.nosotros');
    Route::get( '/productos', [App\Http\Controllers\FrontEndController::class, 'productos'])->name('sitio.productos');
    Route::get( '/servicios', [App\Http\Controllers\FrontEndController::class, 'servicios'])->name('sitio.servicios');

});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});


//Rutas de autenticación
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
