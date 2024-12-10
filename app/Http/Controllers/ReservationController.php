<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Boat;
use App\Models\Reservation;
use App\Models\Season;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Página de bienvenida
    public function showWelcomePage(Request $request)
    {
        $ports = Port::all();
        $boats = Boat::all();

        if ($request->boat_id) {
            $boatId = $request->boat_id;
            $portId = $request->port_id;
            $startDate = $request->pickup_date;
            $endDate = $request->return_date;

            if ($boatId == 3) {
                return redirect()->route('portofino', compact('portId', 'startDate', 'endDate'));
            } elseif ($boatId == 4) {
                return redirect()->route('princess', compact('portId', 'startDate', 'endDate'));
            }
        }

        return view('welcome', compact('ports', 'boats'));
    }

    // Reserva dinámica para cualquier barco
    public function reserveBoat(Request $request, $boatId)
    {
        $boat = Boat::findOrFail($boatId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'port_id' => 'required|exists:ports,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
            'num_persons' => 'nullable|integer|min:1|max:' . $boat->capacity,
        ]);

    // Cálculo del precio total
    $totalPrice = $this->calculateTotalPrice($boatId, $validated['pickup_date'], $validated['return_date']);
        $conflictingReservations = Reservation::where('boat_id', $boatId)
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
// Calculando y guardando el precio total
        $reservation = Reservation::create([
            'port_id' => $validated['port_id'],
            'pickup_date' => $validated['pickup_date'],
            'return_date' => $validated['return_date'],
            'boat_id' => $boatId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'num_persons' => $validated['num_persons'] ?? null,
            'total_price' => $this->calculateTotalPrice($boatId, $validated['pickup_date'], $validated['return_date']),
        ]);


        return redirect()->route('payment', ['reservation' => $reservation->id]);

    }

    // Función para calcular el precio total de la reserva
    public function calculateTotalPrice($boatId, $pickupDate, $returnDate)
    {
        $start = new \DateTime($pickupDate);
        $end = new \DateTime($returnDate);
        $totalPrice = 0;

    // Recorre las fechas entre la fecha de inicio y la fecha de fin
        while ($start <= $end) {
            // Obtener la temporada que cubre la fecha actual
            $season = Season::where('boat_id', $boatId)
                ->where('start_date', '<=', $start->format('Y-m-d'))
                ->where('end_date', '>=', $start->format('Y-m-d'))
                ->first();

                if ($season) {
                    // Si encuentra una temporada, agrega el precio del día
                    $pricePerDay = $season->price_per_day;
                    $totalPrice += $pricePerDay;
                } else {
                    // Si no hay temporada, el precio por día es 0 (puedes manejar este caso según sea necesario)
                    $totalPrice += 0;
                }
        
                // Avanza al siguiente día
                $start->modify('+1 day');
            }
        
            return $totalPrice;
        }

    // Calendario de disponibilidad
    public function calendar($boatId, $portId)
    {
        $reservations = Reservation::where('boat_id', $boatId)
            ->where('port_id', $portId)
            ->get(['pickup_date', 'return_date']);

        $events = $reservations->map(function ($reservation) {
            return [
                'title' => 'Reservado',
                'start' => $reservation->pickup_date,
                'end' => (new \DateTime($reservation->return_date))->modify('+1 day')->format('Y-m-d'),
                'color' => 'red',
                'available' => false,
            ];
        });

        return response()->json($events);
    }

    // Precio dinámico
    public function calculateDynamicPrice(Request $request)
    {
        $boatId = $request->query('boat_id');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$boatId || !$startDate || !$endDate) {
            return response()->json(['error' => 'Faltan parámetros necesarios.'], 400);
        }

        $totalPrice = $this->calculateTotalPrice($boatId, $startDate, $endDate);

        return response()->json(['total_price' => $totalPrice]);
    }

    // Flujo de pasos para la reserva
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
        $reservation = session('reservation');
        if (!$reservation) return redirect()->route('step1')->with('error', 'Completa el paso anterior.');

        // Calcula el precio total para la reserva
        $totalPrice = $this->calculateTotalPrice($reservation['boat_id'], $reservation['pickup_date'], $reservation['return_date']);
        
        // Pasa el total del precio a la vista de Step 3
        return view('reservations.step3', compact('totalPrice'));
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

    // Página de pago
    public function payment($reservationId)
{
    $reservation = Reservation::findOrFail($reservationId);

    // Verificar si el precio total está presente
    if ($reservation->total_price === 0) {
        dd('El precio total no está calculado correctamente.', $reservation);
    }

    return view('reservations.payment', compact('reservation'));
}

    // Confirmación de reserva
    public function confirmation($reservationId)
    {
        $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);
        return view('reservations.confirmation', compact('reservation'));
    }

    // Obtener reservas por puerto
    public function getReservationsByPort(Request $request)
    {
        
        $boatId = $request->query('boat_id');
        $portId = $request->query('port_id');

        if (!$boatId || !$portId) {
            return response()->json(['error' => 'Faltan datos necesarios.'], 400);
        }

        $reservations = Reservation::where('boat_id', $boatId)
            ->where('port_id', $portId)
            ->get(['pickup_date', 'return_date', 'name']);

        return response()->json($reservations);
    }
}
