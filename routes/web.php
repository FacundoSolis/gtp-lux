<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::middleware(['web'])->group(function () {
    // Rutas de inicio
    Route::get('/', [ReservationController::class, 'showWelcomePage'])->name('welcome');

    // Rutas para las páginas de barcos específicos
    Route::get('/sunseeker', [BoatController::class, 'showSunseekerPortofino'])->name('sunseeker');
    Route::get('/princess', [BoatController::class, 'showPrincessV65'])->name('princess');
    Route::get('/boat/{boat_id}', [BoatController::class, 'showBoatPage'])->name('boat.page');

    // Rutas de disponibilidad de barcos
    Route::get('/available-boats', [ReservationController::class, 'showAvailableBoats'])->name('available.boats');
    Route::get('/boats/by-port/{portId}', [BoatController::class, 'getByPort'])->name('boats.byPort');
    Route::get('/reservations/calendar/{boatId}/{portId}', [ReservationController::class, 'calendar'])->name('reservations.calendar');

    // Ruta dinámica para reservar cualquier barco
    Route::post('/boats/{boatId}/reserve', [ReservationController::class, 'reserveBoat'])->name('boats.reserve');

    // Ruta para calcular el precio dinámico
    Route::get('/calculate-price', [ReservationController::class, 'calculateDynamicPrice'])->name('reservations.calculatePrice');

    // Rutas para flujo de pasos de reserva
    Route::get('/reservation/step1', [ReservationController::class, 'showStep1'])->name('step1');
    Route::post('/reservation/step1', [ReservationController::class, 'saveStep1']);
    Route::get('/reservation/step2', [ReservationController::class, 'showStep2'])->name('step2');
    Route::post('/reservation/step2', [ReservationController::class, 'saveStep2']);
    Route::get('/reservation/step3', [ReservationController::class, 'showStep3'])->name('step3');
    Route::post('/reservation/details', [ReservationController::class, 'saveDetails'])->name('reservation.details');

    // Rutas de pago
    Route::get('/payment/{reservation}', [PaymentController::class, 'payment'])->name('payment');
    Route::post('/process-payment/{reservationId}', [PaymentController::class, 'processPayment'])->name('processPayment');

    // Rutas de confirmación
    Route::get('/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('confirmation');

    // Rutas de autenticación (manuales)
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ForgotPasswordController::class, 'reset']);

    // Grupo de rutas protegidas para administración
    Route::middleware(['auth'])->prefix('admin')->group(function () {
        // Gestión de reservas
        Route::post('/reservations', [AdminReservationController::class, 'store'])->name('admin.reservations.store');
        Route::get('/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations.index');
        Route::get('/reservations/{id}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');
        Route::post('/reservations/{id}/update', [AdminReservationController::class, 'update'])->name('admin.reservations.update');
        Route::get('/reservations/{id}/destroy', [AdminReservationController::class, 'destroy'])->name('admin.reservations.destroy');
        Route::post('/reservations/destroyMultiple', [AdminReservationController::class, 'destroyMultiple'])->name('admin.reservations.destroyMultiple');
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/reservations/create', [AdminReservationController::class, 'create'])->name('admin.reservations.create');
        // Gestión de pagos
        Route::get('/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
    });

    // Redirección tras inicio de sesión
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

