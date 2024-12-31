<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name', // Añadir este campo
        'email',
        'phone',
        'port_id',
        'boat_id',
        'pickup_date',
        'return_date',
        'num_persons',
        'total_price',
    ];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function port()
    {
        return $this->belongsTo(Port::class);
    }
}
