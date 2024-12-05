<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Port;
use Illuminate\Http\Request;


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

    public function showValkyrya(Request $request)
{
    $boat = Boat::where('name', 'Valkyrya')->firstOrFail();
    $ports = Port::all();

    // Obtener las fechas de inicio y fin del mes actual
    $startDate = now()->startOfMonth(); // Fecha de inicio del mes
    $endDate = now()->endOfMonth(); // Fecha de fin del mes

    return view('valkyrya', [
        'boatId' => $boat->id, // ID del barco Nadine
        'ports' => $ports,
        'startDate' => $startDate, // Pasar la fecha de inicio
        'endDate' => $endDate, // Pasar la fecha de fin
    ]);
}

    public function showNadine(Request $request)
{
    $boat = Boat::where('name', 'Nadine')->firstOrFail();
    $ports = Port::all();

    // Obtener las fechas de inicio y fin del mes actual
    $startDate = now()->startOfMonth(); // Fecha de inicio del mes
    $endDate = now()->endOfMonth(); // Fecha de fin del mes

    return view('nadine', [
        'boatId' => $boat->id, // ID del barco Nadine
        'ports' => $ports,
        'startDate' => $startDate, // Pasar la fecha de inicio
        'endDate' => $endDate, // Pasar la fecha de fin
    ]);
}
}