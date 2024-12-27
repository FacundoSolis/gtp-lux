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
    // Si no hay fechas, devolver falso para evitar errores
    if (!$pickupDate || !$returnDate) {
        return false;
    }
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
public function calculateDailyPrice($startDate, $endDate)
{
    $startDate = \Carbon\Carbon::parse($startDate);
    $endDate = \Carbon\Carbon::parse($endDate);
    $totalPrice = 0;

    // Iterar a través del rango de fechas
    while ($startDate->lte($endDate)) {
        $season = $this->seasons()
            ->where('start_date', '<=', $startDate)
            ->where('end_date', '>=', $startDate)
            ->first();

        if ($season) {
            $totalPrice += $season->price_per_day; // Usa el precio diario de la temporada
        } else {
            $totalPrice += $this->base_price; // Precio base si no hay temporada
        }

        $startDate->addDay(); // Avanza al siguiente día
    }

    return $totalPrice;
}
public function equipments()
{
    return $this->belongsToMany(Equipment::class, 'boat_equipment');
}

}
