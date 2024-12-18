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

    public function showPrincessV65(Request $request)
{
    $portId = $request->input('port_id', null); // Captura port_id de la solicitud
    $ports = Port::all(); // Obtén todos los puertos
    $boatId = 4; // ID fijo del barco Princess
    $startDate = $request->input('start_date', now()); // Captura start_date o usa la fecha actual
    $endDate = $request->input('end_date', now()->addDays(7)); // Captura end_date o usa una fecha predeterminada

    return view('princess', compact('portId', 'ports', 'boatId', 'startDate', 'endDate'));
}


    public function showSunseekerPortofino(Request $request)
{
    $boat = Boat::where('name', 'Sunseeker Portofino')->firstOrFail();
    $ports = Port::all();

    // Obtener las fechas de inicio y fin del mes actual
    $startDate = now()->startOfMonth(); // Fecha de inicio del mes
    $endDate = now()->endOfMonth(); // Fecha de fin del mes

    return view('portofino', [
        'boatId' => $boat->id, // ID del barco Portofino
        'ports' => $ports,
        'startDate' => $startDate, // Pasar la fecha de inicio
        'endDate' => $endDate, // Pasar la fecha de fin
    ]);
}
public function showBoatPage($boat_id)
{
    $boat = Boat::findOrFail($boat_id);
    // Obtener todos los puertos
    $ports = Port::all();

    
    // Aquí puedes decidir qué vista renderizar, dependiendo del ID del barco.
    if ($boat->id == 3) {
        return view('portofino', compact('boat', 'ports'));  // Vista para el Sunseeker
    } elseif ($boat->id == 4) {
        return view('princess', compact('boat', 'ports'));   // Vista para el Princess
    }

    // Si el barco no es Sunseeker ni Princess, redirigir a la vista predeterminada.
    return view('portofino', compact('boat', 'ports', 'boat_id'));
}
}