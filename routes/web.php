<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\BoatController;

// Ruta de inicio
Route::get('/', [ReservationController::class, 'showWelcomePage'])->name('welcome');

// Ruta para redirigir a la página del barco seleccionado desde welcome
Route::get('/redirect-to-boat', [ReservationController::class, 'redirectToBoat'])->name('reservations.redirect');

// Rutas para disponibilidad
Route::get('/reservations/calendar/{boatId?}/{portId?}/{startDate?}/{endDate?}', [ReservationController::class, 'calendar']);

// Rutas para barcos específicos
Route::get('/valkyrya', [BoatController::class, 'showValkyrya'])->name('valkyrya');
Route::get('/nadine', [BoatController::class, 'showNadine'])->name('nadine');

// Ruta para obtener los barcos disponibles según el puerto y las fechas
Route::get('/available-boats', [ReservationController::class, 'getAvailableBoats']);

// Rutas para obtener barcos según un puerto en formato JSON
Route::get('/boats/by-port/{portId}', [BoatController::class, 'getByPort']);

// Rutas para obtener las reservas
Route::get('/reservations/by-port', [ReservationController::class, 'getReservationsByPort'])->name('reservations.by-port');

// Rutas para reservas directas
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/payment/{reservation}', [ReservationController::class, 'payment'])->name('payment');
Route::get('/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('confirmation');

// Rutas para reservar directamente para los barcos Valkyrya y Nadine
Route::post('/valkyrya/reserve', [ReservationController::class, 'reserveValkyrya'])->name('reserve.valkyrya');
Route::post('/nadine/reserve', [ReservationController::class, 'reserveNadine'])->name('reserve.nadine');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

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
