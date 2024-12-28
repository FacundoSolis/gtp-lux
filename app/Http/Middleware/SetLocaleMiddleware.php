<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        $locale = Session::get('locale', config('app.locale')); // Obtener el idioma de la sesión o usar el predeterminado
        App::setLocale($locale); // Establecer el idioma
        return $next($request);
    }
}
