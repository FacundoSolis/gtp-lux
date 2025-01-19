<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Port;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;




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
    $ports = Port::all();
    $fromWelcome = session('from_welcome', false); // Detectar si viene desde welcome

    // Calcular el precio inicial (opcional)
    $price = 0; // Precio inicial predeterminado
    // Obtener las fechas de inicio y fin del mes actual
    $startDate = now()->startOfMonth(); // Fecha de inicio del mes
    $endDate = now()->endOfMonth(); // Fecha de fin del mes

    // Variables adicionales solo para mostrar reservas y puerto seleccionado
    $portId = $request->input('port_id', session('port_id'));
        $pickupDate = $request->input('pickup_date', session('pickup_date'));
    $returnDate = $request->input('return_date', session('return_date'));
    
    $reservations = Reservation::where('boat_id', $boat->id)
        ->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('pickup_date', [$startDate, $endDate])
                    ->orWhereBetween('return_date', [$startDate, $endDate]);
        })
        ->get();
        $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);

    return view('princess', [
        'boat' => $boat, // Pasamos el barco completo
        'ports' => $ports,
        'price' => $price, // Asegurarse de pasar el precio a la vista
        'startDate' => $startDate, // Pasar la fecha de inicio
        'endDate' => $endDate, // Pasar la fecha de fin
        'fromWelcome' => $fromWelcome,
        // Variables adicionales para las reservas
        'portId' => $portId,
        'pickupDate' => $pickupDate,
        'returnDate' => $returnDate,
        'reservations' => $reservations,
    ]);
}


    public function showSunseekerPortofino(Request $request)
{
    $boat = Boat::where('name', 'Sunseeker Portofino')->firstOrFail();
    $ports = Port::all();
    $fromWelcome = session('from_welcome', false); // Detectar si viene desde welcome

    // Calcular el precio inicial (opcional)
    $price = 0; // Precio inicial predeterminado
    // Obtener las fechas de inicio y fin del mes actual
    $startDate = now()->startOfMonth(); // Fecha de inicio del mes
    $endDate = now()->endOfMonth(); // Fecha de fin del mes

    // Variables adicionales solo para mostrar reservas y puerto seleccionado
    $portId = $request->input('port_id', session('port_id'));
    $pickupDate = $request->input('pickup_date', session('pickup_date'));
    $returnDate = $request->input('return_date', session('return_date'));
    
    // Si no hay fechas, mostrar reservas de todo el mes actual
    $startDate = $pickupDate ?? now()->startOfMonth()->toDateString();
    $endDate = $returnDate ?? now()->endOfMonth()->toDateString();

    // Si se accede desde "welcome", establecer valores predeterminados
    if ($fromWelcome) {
        $portId = 1; // Puerto predeterminado
        $pickupDate = now()->toDateString(); // Hoy
        $returnDate = now()->addDay()->toDateString(); // Mañana
    }

    // Obtener las reservas
    $reservations = [];
    if ($portId) {
        $reservations = Reservation::where('boat_id', $boat->id)
            ->where('port_id', $portId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('pickup_date', [$startDate, $endDate])
                    ->orWhereBetween('return_date', [$startDate, $endDate]);
            })
            ->get();
    }
    $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);


    return view('portofino', [
        'boat' => $boat, // Pasamos el barco completo
        'ports' => $ports,
        'price' => $price, // Asegurarse de pasar el precio a la vista
        'startDate' => $startDate, // Pasar la fecha de inicio
        'endDate' => $endDate, // Pasar la fecha de fin
        'fromWelcome' => $fromWelcome,
        // Variables adicionales para las reservas
        'portId' => $portId,
        'pickupDate' => $pickupDate,
        'returnDate' => $returnDate,
        'reservations' => $reservations,
    ]);
        // Agregar redirección al final
        if ($request->has('redirect_to_form')) {
            return redirect()->route('contacto', [
                'port_id' => $portId,
                'pickup_date' => $pickupDate,
                'return_date' => $returnDate,
                'price' => $price,
            ]);
    
        }
    }
public function showBoatPage($boat_id, Request $request)
{
    $boat = Boat::findOrFail($boat_id); // Encuentra el barco por ID o lanza una excepción
    $ports = Port::all(); // Obtén todos los puertos
    $fromWelcome = session('from_welcome', false); 


    // Captura los parámetros de la URL
    $portId = $request->input('port_id', 1); // Puerto predeterminado: "1"
    $pickupDate = $request->input('pickup_date', now()->toDateString()); // Fecha de hoy si no se pasa
    $returnDate = $request->input('return_date', now()->addDay()->toDateString()); // Día siguiente por defecto
    $price = $request->input('price', 0); // Precio inicial predeterminado

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
            'pickup_time' => 'required|date_format:H:i',
            'dropoff_time' => 'required|date_format:H:i',
            'deposit' => 'required|numeric|min:0',        
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
            'pickup_time' => $validated['pickup_time'], // Hora de recogida
            'dropoff_time' => $validated['dropoff_time'], // Hora de entrega
            'deposit' => $validated['deposit'], // Fianza
        ]);
            // Asignar el `id` recién generado como `boat_id`
        $boat->update(['boat_id' => $boat->id]);
    
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
            'pickup_time' => 'required|date_format:H:i',
            'dropoff_time' => 'required|date_format:H:i',
            'deposit' => 'required|numeric|min:0',
        ]);

            // Obtener la descripción principal y las adicionales (si las hay)
        $description = $request->input('description'); // Descripción principal
        $descriptionData = [
            'es' => $description, // La descripción en español es la principal
        ];

        $boat->update($validated);

        // Guardar las descripciones por idioma
        $description = json_encode($request->input('description'));

        $boat->update([
            'name' => $validated['name'],
            'port_id' => $validated['port_id'],
            'description' => $descriptionData, // Guardar las descripciones como un array en formato JSON
            'pickup_time' => $validated['pickup_time'], // Hora de recogida
            'dropoff_time' => $validated['dropoff_time'], // Hora de entrega
            'deposit' => $validated['deposit'], // Fianza
            // Otros campos que puedas tener...
        ]);

    return redirect()->route('boats.index')->with('success', 'Barco actualizado con éxito.');
}

public function destroy(Boat $boat)
{
    try {
        $boat->delete(); // Eliminar barco
        return redirect()->route('boats.index')->with('success', 'Barco eliminado con éxito.');
    } catch (\Exception $e) {
        return redirect()->route('boats.index')->with('error', 'No se pudo eliminar el barco. Verifica si tiene dependencias.');
    }
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