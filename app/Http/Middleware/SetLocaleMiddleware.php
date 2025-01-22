<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Obtén el idioma desde el segmento de la URL (e.g., /fr/)
        $locale = $request->segment(1);

        // Verifica si el idioma es soportado
        $supportedLocales = config('app.supported_locales');
        if (!in_array($locale, $supportedLocales)) {
            // Si no es válido, usa el idioma predeterminado
            $locale = config('app.locale');
        }

        // Establece el idioma en Laravel y en la sesión
        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }
}
