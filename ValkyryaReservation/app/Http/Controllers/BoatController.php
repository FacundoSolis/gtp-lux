<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Port;

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

    public function showValkyrya()
    {
        $boat = Boat::where('name', 'Valkyrya')->firstOrFail();
        $ports = Port::all();
    
        return view('valkyrya', [
            'boatId' => $boat->id, // ID del barco Valkyrya
            'ports' => $ports      // Lista de puertos
        ]);
    }

    public function showNadine()
    {
        $boat = Boat::where('name', 'Nadine')->firstOrFail();
        $ports = Port::all();

        return view('nadine', [
            'boatId' => $boat->id, // ID del barco Nadine
            'ports' => $ports
        ]);
    }
}