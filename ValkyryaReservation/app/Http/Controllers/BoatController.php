<?php

namespace App\Http\Controllers;

use App\Models\Boat;

class BoatController extends Controller
{
    public function index()
    {
        // Retorna una lista de todos los barcos con información del puerto asociado
        $boats = Boat::with('port')->get();
        return view('boats.index', compact('boats'));
    }

    public function getByPort($portId)
{
    // Obtener barcos asociados al puerto seleccionado
    $boats = Boat::where('port_id', $portId)->get();

    // Devolver los barcos en formato JSON
    return response()->json($boats);
}
}