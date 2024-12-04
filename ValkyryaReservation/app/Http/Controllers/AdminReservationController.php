<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Boat;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    // Listar todas las reservas
    public function index()
    {
        $reservations = Reservation::with('boat', 'port')->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    // Mostrar el formulario de creación de una reserva
    public function create()
    {
        $ports = Port::all(); // Obtener todos los puertos
        $boats = \App\Models\Boat::all(); // Cargar todos los barcos

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
}
