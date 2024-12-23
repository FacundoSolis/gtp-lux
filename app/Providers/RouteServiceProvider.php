<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * El nombre de la ruta del grupo de web.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Namespace por defecto para los controladores.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Registra los servicios de rutas para la aplicación.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
    }

    /**
     * Mapea las rutas del web.php
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace) // Usa el namespace configurado
             ->group(base_path('routes/web.php'));
    }
}
