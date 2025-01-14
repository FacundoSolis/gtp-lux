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
}
