<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryLanguageCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_code',
        'country_name',
        'language_code',
        'language_name',
        'flag',
    ];
    public function translations()
    {
        return $this->hasManyThrough(
            TranslationLanguage::class,
            Translation::class,
            'id', // Clave primaria en Translation
            'translation_id', // Clave foránea en TranslationLanguage
            'id', // Clave primaria en CountryLanguageCode
            'id'  // Clave foránea en Translation
        );
    }
}
