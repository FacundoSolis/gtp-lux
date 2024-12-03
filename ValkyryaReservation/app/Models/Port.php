<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Rellena con los campos relevantes

    // Relación: Un puerto tiene muchos barcos
    public function boats()
    {
        return $this->hasMany(Boat::class);
    }
}
