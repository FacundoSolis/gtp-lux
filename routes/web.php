<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminTranslationController;
use App\Http\Controllers\Admin\CountryLanguageCodeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\ResetPasswordController;

// Grupo principal con middleware 'web'
Route::middleware(['web'])->group(function () {

    /*
     |--------------------------------------------------------------------------
     | Rutas de Idioma y Página Principal
     |--------------------------------------------------------------------------
     */
    // Ruta principal con prefijo de idioma (soporta los idiomas configurados)
    Route::get('/{locale?}', [ReservationController::class, 'showWelcomePage'])
        ->where([
            'locale' => implode('|', config('app.supported_locales')),
            'any'    => '.*'
        ])
        ->name('welcome');

    // Ruta para cambiar el idioma desde el menú
    Route::get('/set-locale/{locale}', function ($locale) {
        $availableLocales = config('app.supported_locales');
        if (in_array($locale, $availableLocales)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        } else {
            abort(400, 'Idioma no válido');
        }
        return back();
    })->name('set-locale');

    /*
     |--------------------------------------------------------------------------
     | Rutas Públicas (Barcos, Reservas, Precios, etc.)
     |--------------------------------------------------------------------------
     */
    Route::get('/sunseeker', [BoatController::class, 'showSunseekerPortofino'])->name('sunseeker');
    Route::get('/princess', [BoatController::class, 'showPrincessV65'])->name('princess');
    Route::get('/boat/{boat_id}', [BoatController::class, 'showBoatPage'])->name('boat.page');
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/pages/{page}', [PageController::class, 'show'])->name('pages.show');

    // Rutas de disponibilidad y reservas
    Route::get('/available-boats', [ReservationController::class, 'showAvailableBoats'])->name('available.boats');
    Route::get('/boats/by-port/{portId}', [BoatController::class, 'getByPort'])->name('boats.byPort');
    Route::get('/reservations/calendar/{boatId}/{portId}', [ReservationController::class, 'calendar'])->name('reservations.calendar');
    Route::get('/available-boats-no-dates', [ReservationController::class, 'showAvailableBoatsWithoutDates'])->name('available.boats.no.dates');
    Route::post('/boats/{boatId}/reserve', [ReservationController::class, 'reserveBoat'])->name('boats.reserve');
    // Ruta pública para crear barco
    Route::post('/boats', [BoatController::class, 'store'])->name('boats.store');

    // Rutas duplicadas (verifica si necesitas ambas o elimina la duplicada)
    Route::post('/boats/{boatId}/reserve', [ReservationController::class, 'reserveBoat'])->name('boats.reserve');
    Route::get('/reservations/all/{boatId}', [ReservationController::class, 'getAllReservations']);
    // Route::get('/reservation/contacto', [ReservationController::class, 'showContacto'])->name('contacto');

    // Ruta para calcular el precio dinámico (reservas)
    Route::get('/calculate-price', [ReservationController::class, 'calculateDynamicPrice'])->name('reservations.calculatePrice');

    // Flujo de pasos para reserva
    Route::get('/reservation/step1', [ReservationController::class, 'showStep1'])->name('step1');
    Route::post('/reservation/step1', [ReservationController::class, 'saveStep1'])->name('step1.save');
    Route::get('/reservation/step2', [ReservationController::class, 'showStep2'])->name('step2');
    Route::post('/reservation/step2', [ReservationController::class, 'saveStep2']);
    Route::get('/reservation/form', [ReservationController::class, 'showForm'])->name('form');
    Route::post('/form', [ReservationController::class, 'handleForm'])->name('form.submit');
    Route::get('/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('confirmation');
    Route::get('/payment/{reservation?}', [ReservationController::class, 'payment'])->name('payment');
    Route::post('/payment/{reservation}', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/reservation/payment/{reservation?}', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/reservation/confirmation/{reservation}', [PaymentController::class, 'confirmation'])->name('confirmation');
    Route::post('/reservation/save', [ReservationController::class, 'saveDetails'])->name('reservation.saveDetails');
    Route::get('/redirect-dates', [ReservationController::class, 'redirectWithDates'])->name('redirect.dates');
    Route::get('/prices/list', [BoatController::class, 'getPriceList'])->name('prices.list');
    Route::get('/get-prices', [PriceController::class, 'getPricesForBoat']);
    Route::get('/calculate-price', [PriceController::class, 'calculatePrice'])->name('calculate.price');
    Route::get('/boats/{boatId}/daily-price', [BoatController::class, 'getDailyPrice']);
    // Route::get('/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('confirmation');

    // Rutas de pago: Stripe
    Route::get('/stripe/create/{reservation}', [StripeController::class, 'createPayment'])->name('stripe.create');
    Route::post('/stripe/process/{reservation}', [StripeController::class, 'processPayment'])->name('stripe.process');
    Route::get('/stripe/cancel/{reservation}', [StripeController::class, 'cancelPayment'])->name('stripe.cancel');

    // Rutas de pago: PayPal
    Route::get('/paypal/create', [PayPalController::class, 'createPayment'])->name('paypal.create');
    Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');
    Route::get('/paypal/test-payment', [PayPalController::class, 'createTestPayment'])->name('paypal.test-payment');

    /*
     |--------------------------------------------------------------------------
     | Rutas de Autenticación para Usuarios No Autenticados (Guest)
     |--------------------------------------------------------------------------
     */
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register']);
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ForgotPasswordController::class, 'reset']);
        // Rutas de 2FA: envío y verificación de token
        Route::get('/2fa', [LoginController::class, 'showTwoFactorForm'])->name('2fa');
        Route::post('/2fa', [LoginController::class, 'verifyTwoFactorToken'])->name('2fa.verify');
    });
    // Aceptación de Cookies
    Route::post('/accept-cookies', function (Illuminate\Http\Request $request) {
        return response('Cookies aceptadas')->cookie('cookie_consent', true, 525600);
    });
    Route::get('/cookies', function () {
        return view('pages.cookies');
    });



    /*
     |--------------------------------------------------------------------------
     | Rutas para Usuarios Autenticados
     |--------------------------------------------------------------------------
     */
    Route::middleware('auth')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

    /*
     |--------------------------------------------------------------------------
     | Rutas de Administración (con Prefijo 'admin' y Middleware 'auth')
     |--------------------------------------------------------------------------
     */
    Route::middleware('auth')->prefix('admin')->group(function () {
        // Gestión de Reservas
        Route::post('/reservations', [AdminReservationController::class, 'store'])->name('admin.reservations.store');
        Route::get('/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations.index');
        Route::get('/reservations/{id}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');
        Route::post('/reservations/{id}/update', [AdminReservationController::class, 'update'])->name('admin.reservations.update');
        Route::get('/reservations/{id}/destroy', [AdminReservationController::class, 'destroy'])->name('admin.reservations.destroy');
        Route::post('/reservations/destroyMultiple', [AdminReservationController::class, 'destroyMultiple'])->name('admin.reservations.destroyMultiple');
        // Gestión de Usuarios
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        // Rutas adicionales de reservas y secciones
        Route::get('/reservations/create', [AdminReservationController::class, 'create'])->name('admin.reservations.create');
        Route::get('/section/{section_name}', [SectionController::class, 'show'])->name('section.show');

        // Gestión de Pagos
        Route::get('/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
        Route::resource('ports', \App\Http\Controllers\PortController::class)->except(['show']);
        Route::resource('boats', BoatController::class)->except(['show']);

        // Gestión de Traducciones
        Route::get('/translations', [AdminTranslationController::class, 'index'])->name('admin.translations.index');
        Route::get('/translations/create', [AdminTranslationController::class, 'create'])->name('admin.translations.create');
        Route::post('/translations', [AdminTranslationController::class, 'store'])->name('admin.translations.store');
        Route::get('/translations/{id}', [AdminTranslationController::class, 'show'])->name('admin.translations.show');
        Route::get('/translations/{id}/edit', [AdminTranslationController::class, 'edit'])->name('admin.translations.edit');
        Route::post('/translations/{id}/update', [AdminTranslationController::class, 'update'])->name('admin.translations.update');
        Route::get('/translations/{id}/destroy', [AdminTranslationController::class, 'destroy'])->name('admin.translations.destroy');
        Route::post('admin/translations/{id}/update', [AdminTranslationController::class, 'update'])->name('admin.translations.update');
        Route::delete('admin/translations/bulk-delete', [AdminTranslationController::class, 'bulkDelete'])->name('admin.translations.bulkDelete');
        Route::get('/admin/translations/export', [AdminTranslationController::class, 'exportTranslations'])->name('admin.translations.export');
        Route::post('/admin/translations/check-key', [AdminTranslationController::class, 'checkKey'])->name('admin.translations.checkKey');

        // Gestión de Códigos de País/Idioma
        Route::prefix('admin/codes')->name('admin.codes.')->group(function () {
            Route::get('/', [CountryLanguageCodeController::class, 'index'])->name('index');
            Route::get('/create', [CountryLanguageCodeController::class, 'create'])->name('create');
            Route::post('/', [CountryLanguageCodeController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CountryLanguageCodeController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CountryLanguageCodeController::class, 'update'])->name('update');
            Route::delete('/{id}', [CountryLanguageCodeController::class, 'destroy'])->name('destroy');
        });

        // Rutas adicionales de administración (Secciones)
        Route::middleware('auth')->prefix('admin')->group(function () {
            Route::get('/sections', [SectionController::class, 'index'])->name('admin.sections.index');
            Route::get('/sections/create', [SectionController::class, 'create'])->name('admin.sections.create');
            Route::post('/sections', [SectionController::class, 'store'])->name('admin.sections.store');
            Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->name('admin.sections.edit');
            Route::put('/sections/{section}', [SectionController::class, 'update'])->name('admin.sections.update');
            Route::post('/sections/{section}/deploy', [SectionController::class, 'deploy'])->name('admin.sections.deploy');
            Route::get('/sections/{section}', [SectionController::class, 'show'])->name('admin.sections.show');
        });
              
        // Rutas extra para Usuarios en Admin
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::put('/admin/users/{user}/password', [UserController::class, 'updatePassword'])->name('admin.users.updatePassword');

    });

    /*
     |--------------------------------------------------------------------------
     | Otras Rutas Públicas
     |--------------------------------------------------------------------------
     */
    Route::post('/contact/send', [ContactController::class, 'sendContactForm'])->name('contact.send');

});
