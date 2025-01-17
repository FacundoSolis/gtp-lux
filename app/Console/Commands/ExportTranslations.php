<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Translation;
use Illuminate\Support\Facades\File;

class ExportTranslations extends Command
{
    protected $signature = 'translations:export';

    protected $description = 'Export translations from the database to JSON files';

    public function handle()
    {
        $translations = Translation::with('languages')->get(); // Obtén todas las traducciones con sus idiomas

        // Idiomas disponibles
        $languages = ['en_us', 'en_gb', 'es', 'fr', 'it', 'de', 'pl', 'ru', 'uk', 'nl'];

        foreach ($languages as $lang) {
            $data = [];
            foreach ($translations as $translation) {
                $languageTranslation = $translation->languages->firstWhere('language_code', $lang);
                $data[$translation->key_name] = $languageTranslation ? $languageTranslation->value : $translation->default_value;
            }

            // Guardar en archivos JSON
            File::put(resource_path("lang/{$lang}.json"), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        $this->info('Translations exported successfully.');
    }
}

