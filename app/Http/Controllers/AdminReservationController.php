<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Boat;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    // Listar todas las reservas con opción de ordenarlas y filtrar por criterios
    public function index(Request $request)
    {
        // Obtener el criterio de ordenación desde la solicitud
        $sortBy = $request->input('sort_by', 'name'); // Orden por nombre por defecto
        $sortDirection = $request->input('sort_direction', 'asc'); // Ascendente por defecto

        // Filtrar y ordenar las reservas
        $reservations = Reservation::with('boat', 'port')
            ->orderBy($sortBy, $sortDirection)
            ->get();

        return view('admin.reservations.index', compact('reservations', 'sortBy', 'sortDirection'));
    }

    // Mostrar el formulario de creación de una reserva
    public function create()
    {
        $ports = Port::all(); // Obtener todos los puertos
        $boats = Boat::all(); // Cargar todos los barcos

        return view('admin.reservations.create', compact('ports', 'boats'));
    }

    // Guardar una nueva reserva
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'port_id' => 'required|exists:ports,id',
            'boat_id' => 'required|exists:boats,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        Reservation::create($validated);

        return redirect()->route('admin.reservations.index')->with('success', 'Reserva creada con éxito.');
    }

    // Eliminar una reserva
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reserva eliminada correctamente.');
    }

    // Eliminar varias reservas seleccionadas
    public function destroyMultiple(Request $request)
{
    $ids = $request->input('ids'); // Obtener los IDs seleccionados
    if ($ids) {
        Reservation::whereIn('id', $ids)->delete(); // Eliminar las reservas
        return redirect()->route('admin.reservations.index')->with('success', 'Reservas eliminadas correctamente.');
    }

    return redirect()->route('admin.reservations.index')->with('error', 'No se seleccionaron reservas.');
}

    // Mostrar el formulario para editar una reserva
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $ports = Port::all();
        $boats = Boat::all();

        return view('admin.reservations.edit', compact('reservation', 'ports', 'boats'));
    }

    // Actualizar los datos de la reserva
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'port_id' => 'required|exists:ports,id',
            'boat_id' => 'required|exists:boats,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($validated);

        return redirect()->route('admin.reservations.index')->with('success', 'Reserva actualizada correctamente.');
    }

    public function deleted()
{
    // Obtener las reservas eliminadas (puedes manejarlo con un soft delete en la base de datos si lo tienes)
    $reservations = Reservation::onlyTrashed()->get();

    return view('admin.reservations.deleted', compact('reservations'));
}

    
}
