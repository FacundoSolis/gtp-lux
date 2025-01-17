<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Translation;
use App\Models\TranslationLanguage;
use Illuminate\Support\Facades\File;

class ImportTranslationsFromJson extends Command
{
    // Firma del comando
    protected $signature = 'translations:import';

    // Descripción del comando
    protected $description = 'Import translations from a JSON file into the database';

    public function handle()
    {
        // Ruta del archivo JSON
        $path = resource_path('lang/translations.json');

        // Verificar si el archivo existe
        if (!File::exists($path)) {
            $this->error("El archivo no existe en la ruta: {$path}");
            return;
        }

        // Leer y decodificar el contenido del archivo JSON
        $content = File::get($path);
        $translations = json_decode($content, true);

        if (!$translations || !is_array($translations)) {
            $this->error('El archivo JSON no tiene un formato válido.');
            return;
        }

        // Procesar cada traducción
        foreach ($translations as $translationData) {
            $key = $translationData['key'] ?? null;
            $defaultValue = $translationData['default_value'] ?? null;
            $isMultilanguage = $translationData['is_multilanguage'] ?? 0;
            $languages = $translationData['languages'] ?? [];

            if (!$key || !$defaultValue) {
                $this->warn("Saltando una entrada inválida: " . json_encode($translationData));
                continue;
            }

            // Crear o actualizar la clave principal en la tabla `translations`
            $translation = Translation::updateOrCreate(
                ['key_name' => $key],
                ['default_value' => $defaultValue, 'is_multilanguage' => $isMultilanguage]
            );

            // Crear o actualizar las traducciones por idioma en la tabla `translation_languages`
            foreach ($languages as $languageCode => $value) {
                TranslationLanguage::updateOrCreate(
                    ['translation_id' => $translation->id, 'language_code' => $languageCode],
                    ['value' => $value]
                );
            }
        }

        $this->info('Traducciones importadas correctamente.');
    }
}


