<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'boat_id',
        'port_id',
        'pickup_date',
        'return_date',
        'name',
        'email',
        'phone',
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
