<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\BoatController;

// Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas para disponibilidad
Route::get('/reservations/calendar/{boat}', [ReservationController::class, 'calendar']);

// Rutas para barcos específicos
Route::get('/valkyrya', [BoatController::class, 'showValkyrya'])->name('valkyrya');
Route::get('/nadine', [BoatController::class, 'showNadine'])->name('nadine');

// Ruta para obtener barcos según un puerto en formato JSON
Route::get('/boats/by-port/{portId}', [BoatController::class, 'getByPort']);

// Rutas para reservas directas
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/payment/{reservation}', [ReservationController::class, 'payment'])->name('payment');
Route::get('/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('confirmation');

// Rutas para el panel administrativo
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [AdminReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [AdminReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}/edit', [AdminReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{reservation}', [AdminReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{reservation}', [AdminReservationController::class, 'destroy'])->name('reservations.destroy');
    // Ruta para eliminar múltiples reservas
    Route::post('/reservations/destroy-multiple', [AdminReservationController::class, 'destroyMultiple'])->name('reservations.destroyMultiple');
});
