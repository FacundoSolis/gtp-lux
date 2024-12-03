<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\PaymentController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas para cada paso del sistema
Route::get('/step1', [ReservationController::class, 'step1'])->name('step1');
Route::post('/step1', [ReservationController::class, 'saveStep1'])->name('saveStep1');

Route::get('/step2', [ReservationController::class, 'step2'])->name('step2');
Route::post('/step2', [ReservationController::class, 'saveStep2'])->name('saveStep2');

Route::get('/step3', [ReservationController::class, 'step3'])->name('step3');
Route::post('/step3', [ReservationController::class, 'saveDetails'])->name('saveDetails');

// Rutas para el pago y confirmación
Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('processPayment');

Route::get('/confirmation', [ReservationController::class, 'confirmation'])->name('confirmation');
