<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = ['key_name', 'default_value', 'is_multilanguage'];

    public function languages()
    {
        return $this->hasMany(TranslationLanguage::class, 'translation_id');
    }
}
