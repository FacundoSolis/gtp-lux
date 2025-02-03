<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Maneja la petición entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check() && Auth::user()->last_activity && Auth::user()->last_activity < Carbon::now()->subHours(12)) {
            Auth::logout();
            return redirect('/login')->with('message', 'Your session has expired. Please log in again.');
        }

        // Actualiza la última actividad
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_activity = Carbon::now();
            $user->save();
        }

        return $next($request);
    }
}
