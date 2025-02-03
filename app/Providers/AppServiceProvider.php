<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Foundation\MaintenanceMode;
use App\MaintenanceMode\FileBasedMaintenanceMode;
use Illuminate\Auth\Passwords\PasswordBrokerManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Asegura que el proveedor de colas se registre para disponer del binding "queue"
        $this->app->register(\Illuminate\Queue\QueueServiceProvider::class);

        // Registrar el binding para 'queue.worker'
        $this->app->singleton('queue.worker', function ($app) {
            return new \Illuminate\Queue\Worker(
                $app['queue'],      // Manager de colas
                $app['events'],     // Dispatcher de eventos
                $app[\Illuminate\Contracts\Debug\ExceptionHandler::class],
                function () use ($app) {
                    return $app->isDownForMaintenance();
                }
            );
        });
        

        // Registrar el binding para 'queue.listener' utilizando el binding anterior
        $this->app->bind('queue.listener', function ($app) {
            return new \Illuminate\Queue\Listener($app['queue.worker']);
        });

        // Registra el binding para el contrato de mantenimiento
        $this->app->singleton(MaintenanceMode::class, function ($app) {
            return new FileBasedMaintenanceMode($app, storage_path('framework/down'));
        });

        // Forzar el binding para auth.password
        $this->app->singleton('auth.password', function ($app) {
            return new PasswordBrokerManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Registra la macro para que el método validate() esté disponible en Request
        Request::macro('validate', function (array $rules, array $messages = [], array $customAttributes = []) {
            $validator = Validator::make($this->all(), $rules, $messages, $customAttributes);
            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }
            return $validator->validated();
        });

        // Composer de vistas (ejemplo existente)
        view()->composer('*', function ($view) {
            $view->with('currentLanguage', session('locale', 'es'));
        });
    }
}
