<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1); // Primer segmento de la URL

        // Comprueba si el idioma es soportado
        if (in_array($locale, config('app.supported_locales'))) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        } elseif (Session::has('locale')) {
            // Usa el idioma de la sesión si no está en la URL
            App::setLocale(Session::get('locale'));
        } else {
            // Usa el idioma predeterminado si no hay configuración
            App::setLocale(config('app.fallback_locale')); // Idioma de respaldo
        }

        return $next($request);
    }
}