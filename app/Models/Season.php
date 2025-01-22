<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'boat_id',
        'name',
        'start_date',
        'end_date',
        'price_per_day',
    ];
    // Relación: Una temporada pertenece a un barco
    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }
}
