<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Boat;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function step1()
    {
        $ports = Port::all(); // Obtener los puertos disponibles
        return view('step1', compact('ports'));
    }

    public function saveStep1(Request $request)
    {
        $validated = $request->validate([
            'port_id' => 'required|exists:ports,id',
        ]);

        session(['port_id' => $validated['port_id']]);

        return redirect()->route('step2');
    }

    public function step2()
    {
        $portId = session('port_id');
        $boats = Boat::where('port_id', $portId)->get(); // Filtrar barcos según el puerto seleccionado
        return view('step2', compact('boats'));
    }

    public function saveStep2(Request $request)
    {
        $validated = $request->validate([
            'boat_id' => 'required|exists:boats,id',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        session(['step2' => $validated]);

        return redirect()->route('step3');
    }

    public function step3()
    {
        return view('step3');
    }

    public function saveDetails(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);

        $step1 = session('port_id');
        $step2 = session('step2');

        $reservationData = array_merge($step2, $validated);
        $reservationData['port_id'] = $step1;

        // Calcular el precio total basado en la temporada
        $startDate = new \DateTime($reservationData['pickup_date']);
        $endDate = new \DateTime($reservationData['return_date']);
        $days = $endDate->diff($startDate)->days;

        $totalPrice = 0;
        $currentDate = clone $startDate;

        while ($currentDate <= $endDate) {
            // Encontrar la temporada para la fecha actual
            $season = \App\Models\Season::where('start_date', '<=', $currentDate->format('Y-m-d'))
                ->where('end_date', '>=', $currentDate->format('Y-m-d'))
                ->first();

            if ($season) {
                $totalPrice += $season->price_per_day;
            } else {
                throw new \Exception('No se encontró temporada para la fecha: ' . $currentDate->format('Y-m-d'));
            }

            $currentDate->modify('+1 day');
        }

        $reservationData['total_price'] = $totalPrice;

        // Crear y guardar la reserva
        $reservation = new Reservation($reservationData);
        $reservation->save();

        return redirect()->route('payment');
    }

    // Agregar el método de confirmación
    public function confirmation()
{
    // Recuperar la última reserva del usuario
    $reservation = Reservation::latest()->first(); // Puedes ajustar esto según tu lógica.

    if (!$reservation) {
        abort(404, 'No se encontró ninguna reserva.');
    }

    // Preparar los detalles de la reserva
    $reservationDetails = [
        'port_id' => $reservation->port->name ?? 'Desconocido', // Asegúrate de que exista la relación port
        'boat_id' => $reservation->boat->name ?? 'Desconocido', // Asegúrate de que exista la relación boat
        'pickup_date' => $reservation->pickup_date,
        'return_date' => $reservation->return_date,
        'name' => $reservation->name,
        'email' => $reservation->email,
        'phone' => $reservation->phone,
    ];

    return view('confirmation', compact('reservationDetails'));
}
}
