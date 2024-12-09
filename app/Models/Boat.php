<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'port_id', 'price_modifier'];

    public function port()
    {
        return $this->belongsTo(Port::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
