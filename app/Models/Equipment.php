<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    // Asegúrate de que el nombre de la tabla es correcto
    protected $table = 'equipments'; 

    // Asegura que solo se puedan rellenar estos campos
    protected $fillable = ['name'];

    // Relación con los barcos
    public function boats()
    {
        return $this->belongsToMany(Boat::class, 'boat_equipment');
    }
}
