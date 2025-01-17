<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class TranslationHelper
{
    public static function get($key)
    {
        $locale = App::getLocale(); // Idioma actual
        $defaultLocale = 'en_us'; // Idioma por defecto
        $translations = Cache::rememberForever('translations', function () {
            $path = resource_path('lang/translations.json');
            if (!file_exists($path)) {
                return [];
            }
            return json_decode(file_get_contents($path), true);
        });

        // Buscar traducción en el idioma actual o usar el idioma por defecto
        return $translations[$key]['languages'][$locale] ?? $translations[$key]['default_value'] ?? $key;
    }
}

