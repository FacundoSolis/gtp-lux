<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'port_id', 'capacity']; // Campos rellenables

    // Relación: Un barco pertenece a un puerto
    public function port()
    {
        return $this->belongsTo(Port::class);
    }

    // Relación: Un barco tiene muchas reservas
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Relación: Un barco tiene muchos precios
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
