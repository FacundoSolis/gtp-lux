<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class TranslationHelper
{
    public static function get($key)
    {
        $locale = App::getLocale(); // Idioma actual
        $defaultLocale = 'EN US'; // Idioma por defecto
        $translations = Cache::rememberForever('translations', function () {
            $path = resource_path('lang/translations.json');
            if (!file_exists($path)) {
                return [];
            }
            return json_decode(file_get_contents($path), true);
        });

        // Busca la traducción en el idioma actual, usa el idioma por defecto si no existe
        return $translations[$key][$locale] ?? $translations[$key][$defaultLocale] ?? $key;
    }
}

