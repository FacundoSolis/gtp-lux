<?php
namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class TranslationHelper
{
    public static function get($key)
    {
        $locale = App::getLocale(); // Idioma actual
        $defaultLocale = 'en_us'; // Idioma por defecto (puedes usarlo si lo deseas)
        
        $translationsArray = Cache::rememberForever('translations', function () {
            $path = resource_path('lang/translations.json');
            if (!file_exists($path)) {
                return [];
            }
            return json_decode(file_get_contents($path), true);
        });

        // Recorrer el array de traducciones y buscar el objeto con la clave solicitada
        foreach ($translationsArray as $translation) {
            if (isset($translation['key']) && $translation['key'] === $key) {
                // Retornar la traducción en el idioma actual o, en su defecto, el valor por defecto
                return $translation['languages'][$locale] ?? $translation['default_value'] ?? $key;
            }
        }

        // Si no se encuentra, retorna la clave misma
        return $key;
    }
}
