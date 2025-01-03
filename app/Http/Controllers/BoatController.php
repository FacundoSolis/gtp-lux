<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Port;
use App\Models\Equipment;
use Illuminate\Http\Request;


class BoatController extends Controller
{
    public function index()
    {
        // Retorna una lista de todos los barcos con información del puerto asociado
        $boats = Boat::with('port')->get();
        return view('admin.boats.index', compact('boats'));
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
    $boat = Boat::where('name', 'Princess V65')->firstOrFail();
    $ports = Port::all(); // Obtén todos los puertos
    $price = 0; // Precio inicial predeterminado
    $startDate = now()->startOfMonth(); // Fecha de inicio del mes
    $endDate = now()->endOfMonth(); // Fecha de fin del mes

    return view('portofino', [
        'boatId' => $boat->id, // ID del barco Portofino
        'ports' => $ports,
        'price' => $price, // Asegurarse de pasar el precio a la vista
        'startDate' => $startDate, // Pasar la fecha de inicio
        'endDate' => $endDate, // Pasar la fecha de fin
    ]);
}

    public function showSunseekerPortofino(Request $request)
{
    $boat = Boat::where('name', 'Sunseeker Portofino')->firstOrFail();
    $ports = Port::all();
    // Calcular el precio inicial (opcional)
    $price = 0; // Precio inicial predeterminado
    // Obtener las fechas de inicio y fin del mes actual
    $startDate = now()->startOfMonth(); // Fecha de inicio del mes
    $endDate = now()->endOfMonth(); // Fecha de fin del mes

    return view('portofino', [
        'boatId' => $boat->id, // ID del barco Portofino
        'ports' => $ports,
        'price' => $price, // Asegurarse de pasar el precio a la vista
        'startDate' => $startDate, // Pasar la fecha de inicio
        'endDate' => $endDate, // Pasar la fecha de fin
    ]);
}
public function showBoatPage($boat_id, Request $request)
{
    $boat = Boat::findOrFail($boat_id); // Encuentra el barco por ID o lanza una excepción
    $ports = Port::all(); // Obtén todos los puertos

    // Captura los parámetros de la URL
    $portId = $request->input('port_id');
    $pickupDate = $request->input('pickup_date');
    $returnDate = $request->input('return_date');
    $price = $request->input('price');

    // Decide qué vista cargar basándose en el ID del barco
    if ($boat->id == 3) {
        // Vista para el Sunseeker Portofino
        return view('portofino', compact('boat', 'ports', 'portId', 'pickupDate', 'returnDate', 'price'));
    } elseif ($boat->id == 4) {
        // Vista para el Princess V65
        return view('princess', compact('boat', 'ports', 'portId', 'pickupDate', 'returnDate', 'price'));
    }

    // Vista genérica si no es ninguno de los anteriores
    return view('boat.show', compact('boat', 'ports', 'portId', 'pickupDate', 'returnDate', 'price'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'port_id' => 'required|exists:ports,id',
            'capacity' => 'nullable|integer|min:1',
            'price_modifier' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'length' => 'nullable|numeric',
            'beam' => 'nullable|numeric',
            'crew' => 'nullable|numeric',
            'engine' => 'nullable|numeric',
        ]);
            // Proveer un valor predeterminado para 'boat_id'
        $validated['boat_id'] = Boat::max('boat_id') + 1;

        $boat = Boat::create([
            'name' => $validated['name'],
            'port_id' => $validated['port_id'],
            'capacity' => $validated['capacity'],
            'price_modifier' => $validated['price_modifier'],
            'description' => $request->description, 
            'length' => $request->length,
            'beam' => $request->beam,
            'crew' => $request->crew,
            'engine' => $request->engine,
            'boat_id' => $validated['boat_id'], // Asigna el valor de boat_id
        ]);
    
        // Solo manejar equipamientos desde el admin
        if ($request->has('equipments')) {
            $boat->equipments()->attach($request->equipments);
        }

        // Guardar los equipos incluidos y no incluidos en el precio
        if ($request->has('included_in_price')) {
            $boat->included_in_price = json_encode($request->included_in_price);
        }

        if ($request->has('not_included_in_price')) {
            $boat->not_included_in_price = json_encode($request->not_included_in_price);
        }

        return redirect()->route('boats.index')->with('success', 'Barco creado con éxito.');
    }

    public function edit(Boat $boat)
    {
        $ports = Port::all();
        $equipments = Equipment::all(); // Obtener todos los equipamientos
        return view('admin.boats.edit', compact('boat', 'ports', 'equipments'));
    }

    public function update(Request $request, Boat $boat)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'port_id' => 'required|exists:ports,id',
            'description' => 'required|string', // La descripción principal debe ser obligatoria
            'description.*' => 'nullable|string', // Las descripciones adicionales pueden ser nulas
        ]);

            // Obtener la descripción principal y las adicionales (si las hay)
        $description = $request->input('description'); // Descripción principal
        $descriptionData = [
            'es' => $description, // La descripción en español es la principal
            'en' => $request->input('description.en', null), // Descripción en inglés (opcional)
            'fr' => $request->input('description.fr', null), // Descripción en francés (opcional)
        ];

        $boat->update($validated);

        // Guardar las descripciones por idioma
        $description = json_encode($request->input('description'));

        $boat->update([
            'name' => $validated['name'],
            'port_id' => $validated['port_id'],
            'description' => $descriptionData, // Guardar las descripciones como un array en formato JSON
            // Otros campos que puedas tener...
        ]);

    return redirect()->route('boats.index')->with('success', 'Barco actualizado con éxito.');
}

    public function destroy(Boat $boat)
    {
        $boat->delete();

    return redirect()->route('boats.index')->with('success', 'Barco eliminado con éxito.');
}
public function getDailyPrice(Request $request, $boatId)
{
    
    $boat = Boat::findOrFail($boatId);

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if (!$startDate || !$endDate) {
        return response()->json(['error' => 'Fechas inválidas'], 400);
    }

    $totalPrice = $boat->calculateDailyPrice($startDate, $endDate);

    return response()->json(['total_price' => $totalPrice]);
}
public function create()
{
    $ports = Port::all(); // Obtener los puertos
    $equipments = Equipment::all(); // Obtener todos los equipamientos
    return view('admin.boats.create', compact('ports', 'equipments'));
}

}