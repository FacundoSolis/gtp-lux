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
        // Obtener todos los puertos
        $ports = Port::all();
        
        // Obtener todos los barcos disponibles
        $boats = Boat::all(); // Obtener todos los barcos disponibles

        // Si se recibe el puerto, barco y fechas desde el formulario, redirigir a la página correspondiente
        if ($request->boat_id) {
            $boatId = $request->boat_id;
            $portId = $request->port_id;
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            // Redirigir a la página de Valkyrya o Nadine con los parámetros seleccionados
            if ($boatId == 1) {
                return redirect()->route('valkyrya', [
                    'port_id' => $portId,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]);
            } elseif ($boatId == 2) {
                return redirect()->route('nadine', [
                    'port_id' => $portId,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]);
            }
        }

        // Pasar las variables $ports y $boats a la vista
        return view('welcome', compact('ports', 'boats'));
    }

    // Método para calcular el precio de una reserva según el barco y la temporada
    public function calculatePrice($boat, $date)
    {
        // Lógica para calcular el precio según la temporada
        $season = \App\Models\Season::where('start_date', '<=', $date->format('Y-m-d'))
            ->where('end_date', '>=', $date->format('Y-m-d'))
            ->first();

        $price = $season ? $season->price_per_day : 100; // Asumir un precio base si no hay temporada
        return $price + $boat->price_modifier; // Sumar el precio del barco
    }

    // Método para manejar la disponibilidad del calendario
    public function calendar($boatId = null, $portId = null, $startDate = null, $endDate = null)
    {
        // Obtener reservas basadas en el barco y el puerto
        $reservations = Reservation::where(function ($query) use ($boatId, $portId) {
            if ($boatId) {
                $query->where('boat_id', $boatId);
            }
            if ($portId) {
                $query->whereHas('boat', function ($q) use ($portId) {
                    $q->where('port_id', $portId);
                });
            }
        })->get(['pickup_date', 'return_date']);

        $events = [];
        $occupiedDates = [];

        // Agregar las reservas como días ocupados
        foreach ($reservations as $reservation) {
            $start = new \DateTime($reservation->pickup_date);
            $end = new \DateTime($reservation->return_date);
            $end->modify('+1 day'); // FullCalendar requiere que el día final no se incluya.

            $occupiedDates[] = $start->format('Y-m-d');
            $occupiedDates[] = $end->format('Y-m-d');

            $events[] = [
                'title' => 'Reservado',
                'start' => $start->format('Y-m-d'),
                'end' => $end->format('Y-m-d'),
                'color' => 'red', // Rojo para los días ocupados
            ];
        }

        // Si el puerto fue seleccionado, mostrar los barcos disponibles con precios y temporadas
        if ($portId) {
            $boats = Boat::where('port_id', $portId)->get();
            $startDate = $startDate ? new \DateTime($startDate) : now();
            $endDate = $endDate ? new \DateTime($endDate) : now()->addMonths(1);

            // Generar fechas disponibles y asociar colores según la temporada
            $currentDate = clone $startDate;
            while ($currentDate <= $endDate) {
                $dateStr = $currentDate->format('Y-m-d');
                if (!in_array($dateStr, $occupiedDates)) {
                    foreach ($boats as $boat) {
                        // Verificar la temporada del día
                        $season = \App\Models\Season::where('start_date', '<=', $currentDate->format('Y-m-d'))
                            ->where('end_date', '>=', $currentDate->format('Y-m-d'))
                            ->first();

                        $price = $this->calculatePrice($boat, $currentDate); // Obtener el precio

                        // Determinar el color según la temporada
                        $color = 'green'; // Default color for available dates
                        if ($season) {
                            if ($season->name == 'Alta') {
                                $color = 'red'; // Alta temporada (rojo)
                            } elseif ($season->name == 'Media') {
                                $color = 'yellow'; // Media temporada (amarillo)
                            }
                        }

                        $events[] = [
                            'title' => $boat->name,
                            'start' => $dateStr,
                            'end' => $dateStr,
                            'color' => $color, // Verde para libres, rojo/amarillo para temporada
                            'price' => $price, // Precio para el día
                        ];
                    }
                }
                $currentDate->modify('+1 day');
            }
        }

        return response()->json($events);
    }

    // Método para mostrar la página de Valkyrya
    public function showValkyrya(Request $request)
    {
        // Si viene desde la página de inicio con datos de puerto y fechas, se pasan a la vista
        $portId = $request->port_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $ports = Port::all();  // Obtener todos los puertos

        return view('valkyrya', compact('ports', 'portId', 'startDate', 'endDate'));
    }

    // Método para mostrar la página de Nadine
    public function showNadine(Request $request)
    {
        // Si viene desde la página de inicio con datos de puerto y fechas, se pasan a la vista
        $portId = $request->port_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $ports = Port::all();  // Obtener todos los puertos

        return view('nadine', compact('ports', 'portId', 'startDate', 'endDate'));
    }

    // Paso 2: Seleccionar barco y fechas
    public function step2()
    {
        $reservation = session('reservation');
        if (!$reservation) {
            return redirect()->route('step1')->with('error', 'Completa el paso anterior.');
        }

        $boats = Boat::where('port_id', $reservation['port_id'])->get();
        return view('step2', compact('boats'));
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

    // Paso 3: Datos del cliente
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

        $reservationData = array_merge(session('reservation'), $validated);
        $reservation = Reservation::create($reservationData);

        return redirect()->route('payment');
    }

    // Confirmación
    public function confirmation($reservationId)
    {
        // Obtener la reserva por ID
        $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);

        // Pasar la reserva a la vista de confirmación
        return view('confirmation', compact('reservation'));
    }

    // Guardar reservas desde Nadine
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'port_id' => 'required|exists:ports,id',
            'boat_id' => 'required|exists:boats,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        // Verificar si las fechas ya están reservadas
        $conflictingReservations = Reservation::where('boat_id', $validated['boat_id'])
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
                'pickup_date' => 'El barco no está disponible en estas fechas. Por favor elige otras fechas.'
            ])->withInput();
        }

        // Obtener el barco seleccionado
        $boat = \App\Models\Boat::findOrFail($validated['boat_id']);

        // Calcular el precio total basado en las temporadas
        $pickupDate = new \DateTime($validated['pickup_date']);
        $returnDate = new \DateTime($validated['return_date']);
        $days = $returnDate->diff($pickupDate)->days + 1;

        $totalPrice = 0;
        $currentDate = clone $pickupDate;

        while ($currentDate <= $returnDate) {
            $season = \App\Models\Season::where('start_date', '<=', $currentDate->format('Y-m-d'))
                ->where('end_date', '>=', $currentDate->format('Y-m-d'))
                ->first();

            if ($season) {
                // Sumar precio base más el modificador del barco
                $totalPrice += $season->price_per_day + $boat->price_modifier;
            } else {
                throw new \Exception('No se encontró temporada para la fecha: ' . $currentDate->format('Y-m-d'));
            }

            $currentDate->modify('+1 day');
        }

        // Agregar el precio total a los datos validados
        $validated['total_price'] = $totalPrice;

        // Crear la reserva
        $reservation = Reservation::create($validated);

        // Redirigir a la página de pago
        return redirect()->route('payment', ['reservation' => $reservation->id]);
    }

    // Método para el pago
    public function payment($reservationId)
    {
        // Obtener la reserva por ID
        $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);

        // Pasar la reserva a la vista de pago
        return view('payment', compact('reservation'));
    }
}
