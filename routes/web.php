<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\Admin\AdminPaymentController;


// Ruta de inicio
Route::get('/', [ReservationController::class, 'showWelcomePage'])->name('welcome');

Route::get('/sunseeker', [BoatController::class, 'showSunseekerPortofino'])->name('sunseeker');

// Rutas disponibilidad barcos
Route::get('/available-boats', [ReservationController::class, 'showAvailableBoats'])->name('available.boats');
Route::get('/reservations/calendar/{portId}', [ReservationController::class, 'calendar'])->name('reservations.calendar.store');

// Ruta para la página de un barco específico
Route::get('/boat/{boat_id}', [BoatController::class, 'showBoatPage'])->name('boat.page');

// Rutas para las páginas específicas de los barcos
Route::get('/princess', [BoatController::class, 'showPrincessV65'])->name('princess');

// Ruta dinámica para reservar cualquier barco
Route::post('/boats/{boatId}/reserve', [ReservationController::class, 'reserveBoat'])->name('boats.reserve');

// Rutas de disponibilidad
Route::get('/reservations/calendar/{boatId}/{portId}', [ReservationController::class, 'calendar'])->name('reservations.calendar');

// Ruta para calcular el precio dinámico
Route::get('/calculate-price', [ReservationController::class, 'calculateDynamicPrice'])->name('reservations.calculatePrice');

// Rutas adicionales necesarias
Route::get('/boats/by-port/{portId}', [BoatController::class, 'getByPort'])->name('boats.byPort');
Route::get('/reservations/by-port', [ReservationController::class, 'getReservationsByPort'])->name('reservations.by-port');

// Rutas para flujo de pasos de la reserva
Route::get('/reservation/step1', [ReservationController::class, 'showStep1'])->name('step1');
Route::post('/reservation/step1', [ReservationController::class, 'saveStep1']);
Route::get('/reservation/step2', [ReservationController::class, 'showStep2'])->name('step2');
Route::post('/reservation/step2', [ReservationController::class, 'saveStep2']);
Route::get('/reservation/step3', [ReservationController::class, 'showStep3'])->name('step3');
Route::post('/reservation/details', [ReservationController::class, 'saveDetails'])->name('reservation.details');

// Rutas de pago y confirmación
Route::get('/payment/{reservation}', [ReservationController::class, 'payment'])->name('payment');
Route::get('/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('confirmation');

Route::prefix('admin')->group(function() {
    // Página de administración de reservas
    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations.index');
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index'); // Agregar ruta para AdminPaymentController

    // Página de edición de una reserva
    Route::get('/reservations/{id}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');
    
    // Guardar cambios en la reserva
    Route::post('/reservations/{id}/update', [AdminReservationController::class, 'update'])->name('admin.reservations.update');

    // Eliminar una reserva
    Route::get('/reservations/{id}/destroy', [AdminReservationController::class, 'destroy'])->name('admin.reservations.destroy');
    
    // Eliminar múltiples reservas
    Route::post('/reservations/destroyMultiple', [AdminReservationController::class, 'destroyMultiple'])->name('admin.reservations.destroyMultiple');
    
});
