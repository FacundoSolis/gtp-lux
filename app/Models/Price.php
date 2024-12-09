<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['boat_id', 'start_date', 'end_date', 'price_per_day']; // Campos rellenables

    // Relación: Un precio pertenece a un barco
    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }
}
