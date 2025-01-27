<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'template_name',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'content',
        'params',
    ];

    protected $casts = [
        'params' => 'array', // Para almacenar datos en formato JSON
    ];
}
