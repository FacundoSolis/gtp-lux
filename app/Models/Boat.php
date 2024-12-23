<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'port_id', 'capacity', 'price_modifier', 'boat_id'];

    public function port()
    {
        return $this->belongsTo(Port::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // En el modelo Boat.php
    public function isReserved($pickupDate, $returnDate)
{
    return $this->reservations()
        ->where(function ($query) use ($pickupDate, $returnDate) {
            $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                ->orWhere(function ($query) use ($pickupDate, $returnDate) {
                    $query->where('pickup_date', '<=', $pickupDate)
                          ->where('return_date', '>=', $returnDate);
                });
        })
        ->exists();
}
    public function seasons()
    {
        return $this->hasMany(Season::class);
}

}
