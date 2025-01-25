<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Detectar el idioma del primer segmento de la URL
        $locale = $request->segment(1); 
        // Comprueba si el idioma es soportado
        if (in_array($locale, array_keys(config('languages')))) {
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