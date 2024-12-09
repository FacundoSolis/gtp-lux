<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Boat;
use App\Models\Reservation;
use App\Models\Season;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Método para cargar la página de bienvenida
    public function showWelcomePage(Request $request)
    {
        $ports = Port::all();
        $boats = Boat::all();

        if ($request->boat_id) {
            $boatId = $request->boat_id;
            $portId = $request->port_id;
            $startDate = $request->pickup_date;
            $endDate = $request->return_date;

            // Redirigir según el barco seleccionado
            if ($boatId == 3) {
                return redirect()->route('sunseeker', compact('portId', 'startDate', 'endDate'));
            } elseif ($boatId == 4) {
                return redirect()->route('princess', compact('portId', 'startDate', 'endDate'));
            }
        }

        return view('welcome', compact('ports', 'boats'));
    }

    // Reserva para el barco Sunseeker Portofino 53
    public function reserveSunseeker(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'port_id' => 'required|exists:ports,id',
            'boat_id' => 'required|exists:boats,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        // Verificar si ya existe una reserva en esas fechas para este barco
        $conflictingReservations = Reservation::where('boat_id', 3) // Sunseeker ID
            ->where(function ($query) use ($validated) {
                $query->whereBetween('pickup_date', [$validated['pickup_date'], $validated['return_date']])
                    ->orWhereBetween('return_date', [$validated['pickup_date'], $validated['return_date']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('pickup_date', '<=', $validated['pickup_date'])
                            ->where('return_date', '>=', $validated['return_date']);
                    });
            })->exists();

        if ($conflictingReservations) {
            return redirect()->back()->withErrors([
                'pickup_date' => 'El barco ya está reservado en las fechas seleccionadas. Por favor elige otras fechas.',
            ])->withInput();
        }

        // Crear la reserva para Sunseeker
        $reservation = Reservation::create([
            'port_id' => $validated['port_id'],
            'pickup_date' => $validated['pickup_date'],
            'return_date' => $validated['return_date'],
            'boat_id' => 3, // ID del Sunseeker Portofino 53
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'total_price' => $this->calculateTotalPrice(3, $validated['pickup_date'], $validated['return_date']),
        ]);

        return redirect()->route('payment', ['reservation' => $reservation->id]);
    }

    // Reserva para el barco Princess V65
    public function reservePrincess(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'port_id' => 'required|exists:ports,id',
            'boat_id' => 'required|exists:boats,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        // Verificar si ya existe una reserva en esas fechas para este barco
        $conflictingReservations = Reservation::where('boat_id', 4) // Princess V65 ID
            ->where(function ($query) use ($validated) {
                $query->whereBetween('pickup_date', [$validated['pickup_date'], $validated['return_date']])
                    ->orWhereBetween('return_date', [$validated['pickup_date'], $validated['return_date']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('pickup_date', '<=', $validated['pickup_date'])
                            ->where('return_date', '>=', $validated['return_date']);
                    });
            })->exists();

        if ($conflictingReservations) {
            return redirect()->back()->withErrors([
                'pickup_date' => 'El barco ya está reservado en las fechas seleccionadas. Por favor elige otras fechas.',
            ])->withInput();
        }

        // Crear la reserva para Princess V65
        $reservation = Reservation::create([
            'port_id' => $validated['port_id'],
            'pickup_date' => $validated['pickup_date'],
            'return_date' => $validated['return_date'],
            'boat_id' => 4, // ID del Princess V65
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'total_price' => $this->calculateTotalPrice(4, $validated['pickup_date'], $validated['return_date']),
        ]);

        return redirect()->route('payment', ['reservation' => $reservation->id]);
    }

    // Función para calcular el precio total de la reserva
    public function calculateTotalPrice($boatId, $pickupDate, $returnDate)
    {
        $boat = Boat::findOrFail($boatId); // Obtener los detalles del barco
        $start = new \DateTime($pickupDate); // Fecha de inicio
        $end = new \DateTime($returnDate); // Fecha de fin

        $totalPrice = 0;

        // Recorrer cada día entre las fechas de la reserva
        while ($start <= $end) {
            // Buscar la temporada que corresponde a la fecha actual
            $season = Season::where('start_date', '<=', $start->format('Y-m-d'))
                            ->where('end_date', '>=', $start->format('Y-m-d'))
                            ->first();

            // Si se encuentra una temporada, añadir el precio correspondiente
            $price = $season ? $season->price_per_day : 100; // Precio por defecto si no se encuentra una temporada
            $totalPrice += $price + $boat->price_modifier; // Sumar el precio por día del barco y la temporada

            // Pasar al siguiente día
            $start->modify('+1 day');
        }

        return $totalPrice; // Devolver el precio total
    }

    // Flujo de pasos para la reserva (Step 1, Step 2, etc.)
    public function showStep1()
    {
        $ports = Port::all();
        return view('reservations.step1', compact('ports'));
    }

    public function saveStep1(Request $request)
    {
        $validated = $request->validate([
            'port_id' => 'required|exists:ports,id',
        ]);

        session()->put('reservation', $validated);
        return redirect()->route('step2');
    }

    public function showStep2()
    {
        $reservation = session('reservation');
        if (!$reservation) return redirect()->route('step1')->with('error', 'Completa el paso anterior.');

        $boats = Boat::where('port_id', $reservation['port_id'])->get();
        return view('reservations.step2', compact('boats'));
    }

    public function saveStep2(Request $request)
    {
        $validated = $request->validate([
            'boat_id' => 'required|exists:boats,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        session()->put('reservation', array_merge(session('reservation'), $validated));
        return redirect()->route('step3');
    }

    public function showStep3()
    {
        return view('reservations.step3');
    }

    public function saveDetails(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ]);

        $reservationData = array_merge(session('reservation'), $validated);
        $reservation = Reservation::create($reservationData);

        return redirect()->route('payment', ['reservation' => $reservation->id]);
    }

    public function payment($reservationId)
    {
        $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);
        return view('reservations.payment', compact('reservation'));
    }

    public function confirmation($reservationId)
    {
        $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);
        return view('reservations.confirmation', compact('reservation'));
    }

    // Obtiene reservas para barco seleccionado en un puerto especifico
    public function getReservationsByPort(Request $request)
    {
        $boatId = $request->query('boat_id');
        $portId = $request->query('port_id');

        // Validar que ambos parámetros existan
        if (!$boatId || !$portId) {
            return response()->json(['error' => 'Faltan datos necesarios.'], 400);
        }

        // Obtener reservas para el barco y puerto seleccionados
        $reservations = Reservation::where('boat_id', $boatId)
            ->where('port_id', $portId)
            ->get(['pickup_date', 'return_date', 'name']); // Selecciona los campos necesarios

        return response()->json($reservations);
    }
}
