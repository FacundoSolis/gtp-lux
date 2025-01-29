<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function show($page)
    {
        // Obtener el idioma de la sesión o el predeterminado
        $locale = Session::get('locale', config('app.locale'));

        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        // Aplicar el idioma en toda la página
        App::setLocale($locale);

        // Verificar si la vista existe antes de cargarla
        if (!view()->exists("pages.$page")) {
            abort(404);
        }

        return view("pages.$page");
    }
}

