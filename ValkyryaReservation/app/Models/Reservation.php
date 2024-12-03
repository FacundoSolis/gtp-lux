<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'boat_id', 
        'port_id', 
        'pickup_date', 
        'return_date', 
        'total_price'
    ];

    // Relación con barcos
    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    // Relación con puertos
    public function port()
    {
        return $this->belongsTo(Port::class);
    }
}
