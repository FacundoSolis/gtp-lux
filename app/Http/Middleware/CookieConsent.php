<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CookieConsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasCookie('cookie_consent')) {
            view()->share('showCookieModal', true); // Indica que debe mostrarse el modal.
        } else {
            view()->share('showCookieModal', false); // El modal no se mostrará.
        }

        return $next($request);
    }
}
