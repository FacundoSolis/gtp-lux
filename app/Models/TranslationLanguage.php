<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslationLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['translation_id', 'language_code', 'value'];

    public function translation()
    {
        return $this->belongsTo(Translation::class);
    }
}
