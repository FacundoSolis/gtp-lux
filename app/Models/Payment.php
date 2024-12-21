<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Si la tabla se llama diferente, especifica el nombre:
    // protected $table = 'nombre_tabla';

    // Define los campos asignables en el modelo
    protected $fillable = [
        'amount', // Ajusta según las columnas de la tabla
        'reservation_id',
        'payment_date',
    ];
}
