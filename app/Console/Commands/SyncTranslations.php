<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncTranslations extends Command
{
    protected $signature = 'translation:sync';
    protected $description = 'Sync translations from translations.json to translation_languages';

    public function handle()
    {
        $filePath = resource_path('lang/translations.json');

        if (!file_exists($filePath)) {
            $this->error('File not found: ' . $filePath);
            return;
        }

        $translations = json_decode(file_get_contents($filePath), true);

        if (!$translations) {
            $this->error('Invalid JSON format in ' . $filePath);
            return;
        }

        foreach ($translations as $translation) {
            $keyName = $translation['key'] ?? null; // Ajustamos para que busque 'key_name'
            $languages = $translation['languages'] ?? [];

            if (!$keyName || !$languages) {
                $this->warn('Skipping invalid entry: ' . json_encode($translation));
                continue;
            }

            // Encontrar la clave en la tabla translations
            $translationRecord = DB::table('translations')->where('key_name', $keyName)->first();

            if (!$translationRecord) {
                $this->warn("Key not found in translations table: $keyName");
                continue;
            }

            $translationId = $translationRecord->id;

            foreach ($languages as $locale => $value) {
                // Actualizar o insertar en translation_languages
                DB::table('translation_languages')->updateOrInsert(
                    [
                        'translation_id' => $translationId,
                        'language_code' => $locale, // Ajustamos para usar 'language_code'
                    ],
                    [
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            $this->info("Translations synced for key: $keyName");
        }

        $this->info('Translation sync complete.');
    }
}
