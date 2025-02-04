<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Boat;
use App\Models\Reservation;
use App\Models\Season;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Mail\ReservationConfirmationMail;
use Illuminate\Support\Facades\Mail;


class ReservationController extends Controller
{
    // Página de bienvenida
    public function showWelcomePage(Request $request)
    {
        $ports = Port::all();
        $boats = Boat::all();

        if ($request->boat_id) {
            $boatId = $request->boat_id;
            $portId = $request->input('port_id', 1); // Puerto predeterminado
            $pickupDate = $request->input('pickup_date');
            $returnDate = $request->input('return_date');
            $price = $this->calculateTotalPrice($boatId, $pickupDate, $returnDate);

 
            if ($boatId == 3) {
                return redirect()->route('sunseeker', [
                    'port_id' => $portId,
                    'pickup_date' => $request->input('pickup_date'),
                    'return_date' => $request->input('return_date'),
                    'price' => $price,
                ])->with('from_welcome', true);
            } elseif ($boatId == 4) {            
                return redirect()->route('princess', [
                    'port_id' => $portId,
                    'pickup_date' => $request->input('pickup_date'),
                    'return_date' => $request->input('return_date'),
                    'price' => $price,
                ])->with('from_welcome', true);
            }
    }
        $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);

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
    if ($totalPrice <= 0) {
        return redirect()->back()->withErrors([
            'price' => 'No se pudo calcular el precio. Por favor verifica las fechas seleccionadas.',
        ])->withInput();
    }

   // Verificar si hay conflictos en las reservas
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
            'total_price' => $totalPrice, // Aquí usamos el precio calculado
        ]);
        return redirect()->route('payment', ['reservation' => $reservation->id]);
    }

    // Función para calcular el precio total de la reserva
    public function calculateTotalPrice($boatId, $pickupDate, $returnDate)
    {
        Log::info('Calculando precio total', [
            'boat_id' => $boatId,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
        ]);
        if (!$pickupDate || !$returnDate || !$boatId) {
            Log::error('Datos insuficientes para calcular el precio.', [
                'boat_id' => $boatId,
                'pickup_date' => $pickupDate,
                'return_date' => $returnDate,
            ]);
            return 0; // Asegurarse de no devolver un precio erróneo
        }
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
                    Log::warning('No se encontró temporada para la fecha.', [
                        'date' => $start->format('Y-m-d'),
                        'boat_id' => $boatId,
                    ]);
                }
        
                // Avanza al siguiente día
                $start->modify('+1 day');
            }
            Log::info('Precio total calculado correctamente', ['total_price' => $totalPrice]);
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
        return view('step1', compact('ports'));
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
        return view('step2', compact('boats'));
    }

    public function saveStep2(Request $request)
    {
        $validated = $request->validate([
            'boat_id' => 'required|exists:boats,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

          // Combinar con los datos del paso anterior
        $reservationData = array_merge(session('reservation', []), $validated);
        session()->put('reservation', $reservationData);
        
        return redirect()->route('step3');
    }

    public function showStep3()
    {
        $reservation = session('reservation');
        if (!$reservation) return redirect()->route('step1')->with('error', 'Completa el paso anterior.');

        // Calcula el precio total para la reserva
        $totalPrice = $this->calculateTotalPrice($reservation['boat_id'], $reservation['pickup_date'], $reservation['return_date']);
        
        // Pasa el total del precio a la vista de Step 3
        return view('step3', compact('totalPrice'));
    }
    public function showContacto(Request $request)
{
    // Si no se pasa un port_id, usa el puerto por defecto (1)
    $portId = $request->input('port_id', 1);
    $pickupDate = $request->input('pickup_date');
    $returnDate = $request->input('return_date');
    $boatId = $request->input('boat_id');
    $price = $request->input('price', 0);

    if (!$portId || !$pickupDate || !$returnDate || !$boatId) {
        return redirect()->route('step1')->withErrors(['error' => 'Puerto no encontrado']);
    }
    $port = Port::findOrFail($portId);
    $boat = Boat::findOrFail($boatId);

    $reservation = [
        'id' => null, // Si aún no se ha creado en la base de datos
        'port_id' => $portId,
        'port_name' => $port->name,
        'pickup_date' => $pickupDate,
        'return_date' => $returnDate,
        'boat_id' => $boatId,
        'price' => $request->input('price', 0), // Precio predeterminado a 0 si no está presente
    ];

    $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);

    return view('form', compact('reservation'));
}

public function saveDetails(Request $request)
{
    // Validar los datos del formulario
    $validated = $request->validate([
        'port_id' => 'required|exists:ports,id',
        'pickup_date' => 'required|date',
        'return_date' => 'required|date|after:pickup_date',
        'boat_id' => 'required|exists:boats,id',
        'price' => 'required|numeric|min:0', // Validar que el precio sea mayor a 0
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
    ]);

    // Crear la reserva en la base de datos
    $reservation = Reservation::create([
        'port_id' => $validated['port_id'],
        'pickup_date' => $validated['pickup_date'],
        'return_date' => $validated['return_date'],
        'boat_id' => $validated['boat_id'],
        'name' => $validated['name'],
        'surname' => $validated['surname'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'total_price' => $validated['price'],
    ]);

    // Redirigir a la página de pago
    return redirect()->route('payment', ['reservation' => $reservation->id]);
}

    public function showForm(Request $request)
{
    Log::info('Entrando en showForm', ['request_params' => $request->all()]);

    $portId = $request->input('port_id', 1);
    $pickupDate = $request->input('pickup_date');
    $returnDate = $request->input('return_date');
    $boatId = $request->input('boat_id');
    $price = $request->input('price', 0); // Obtén el precio de la URL o usa 0 como predeterminado

    
    // Si no hay precio, calcula uno
    if (!$price || $price === 0) {
        Log::info('Calculando precio total', [
            'boat_id' => $boatId,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
        ]);
        $price = $this->calculateTotalPrice($boatId, $pickupDate, $returnDate);
        Log::info('Precio total calculado correctamente', ['total_price' => $price]);
    }
    if (!$portId || !$boatId || !$pickupDate || !$returnDate || $price <= 0) {
        Log::error('Faltan datos necesarios para el formulario', [
            'port_id' => $portId,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
            'boat_id' => $boatId,
            'price' => $price,
        ]);        
        return redirect()->route('step1')->withErrors(['error' => 'Faltan datos necesarios para completar la reserva.']);
    }
    Log::info('Preparando la vista con el precio calculado.', ['price' => $price]);


    $port = Port::findOrFail($portId);
    $boat = Boat::findOrFail($boatId);

    $reservation = [
        'id' => null, // ID vacío si no se ha guardado aún
        'port_id' => $portId,
        'port_name' => $port->name,
        'pickup_date' => $pickupDate,
        'return_date' => $returnDate,
        'boat_id' => $boatId,
        'price' => $price,
    ];
    $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);

    return view('form', compact('reservation'));
}

public function handleForm(Request $request)
{
    $validated = $request->validate([
        'port_id' => 'required|exists:ports,id',
        'pickup_date' => 'required|date',
        'return_date' => 'required|date|after:pickup_date',
        'boat_id' => 'required|exists:boats,id',
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email',
        'email_confirm' => 'required|email|same:email',
        'phone' => 'required|string|max:15',
        'price' => 'required|numeric|min:0',
    ]);
    $reservation = Reservation::create($validated);
    // Asegurarte de que se creó correctamente
    if (!$reservation->id) {
        return redirect()->back()->withErrors(['error' => 'No se pudo crear la reserva. Inténtalo de nuevo.']);
    }

    return redirect()->route('payment', ['reservation' => $reservation->id]);
}

    // Página de pago
    public function payment(Request $request, $reservationId = null)
{
    if ($reservationId) {
        // Caso en el que se pasa el ID de la reserva
        $reservation = Reservation::findOrFail($reservationId);
    } else {
        // Caso en el que se usan datos de sesión
        $reservation = session('reservation');
        if (!$reservation) return redirect()->route('step1')->with('error', 'Completa el paso anterior.');
    }

    // Verificar que el precio total esté presente
    if (!isset($reservation['total_price']) || $reservation['total_price'] === 0) {
        return redirect()->back()->withErrors(['error' => 'El precio de la reserva no está calculado correctamente.']);
    }
    $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);


    return view('reservations.payment', compact('reservation'));
}
public function processPayment(Request $request, $reservationId)
{
    $reservation = Reservation::findOrFail($reservationId);

    // Asegúrate de que todos los datos requeridos estén completos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:15',
        'status' => 'processing',
    ]);

    // Actualiza los datos de contacto en la reserva
    $reservation->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
    ]);
    $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);


    // Redirigir a la página de métodos de pago
    return redirect()->route('confirmation', ['reservation' => $reservation->id]);
}

    // Confirmación de reserva
    public function confirmation($reservationId)
    {
        $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);
        $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);

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

    // ReservationController.php

    public function showAvailableBoats(Request $request)
{
    $portId = $request->input('port_id');
    $pickupDate = $request->input('pickup_date');
    $returnDate = $request->input('return_date');

    if (!$pickupDate || !$returnDate) {
        return redirect()->back()->withErrors(['message' => 'Por favor selecciona ambas fechas.']);
    }

    // Obtener todos los barcos del puerto seleccionado
    $boats = Boat::where('port_id', $portId)
        ->with(['reservations' => function ($query) use ($pickupDate, $returnDate) {
            $query->where(function ($q) use ($pickupDate, $returnDate) {
                $q->whereBetween('pickup_date', [$pickupDate, $returnDate])
                  ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                  ->orWhereRaw('? BETWEEN pickup_date AND return_date', [$pickupDate])
                  ->orWhereRaw('? BETWEEN pickup_date AND return_date', [$returnDate]);
            });
        }])
        ->get();

    // Identificar barcos reservados
    $boats = $boats->map(function ($boat) use ($pickupDate, $returnDate) {
        $boat->is_reserved = $boat->reservations->isNotEmpty(); // Indica si está reservado
        $boat->pickup_date = $pickupDate;
        $boat->return_date = $returnDate;
        return $boat;
    });
    $locale = Session::get('locale', config('app.locale'));
        if (!$locale) {
            Log::warning("Idioma no encontrado en la sesión. Usando predeterminado: " . config('app.locale'));
        }

        Log::info("Idioma actual: $locale");

        App::setLocale($locale);


    return view('available_boats', compact('boats', 'portId', 'pickupDate', 'returnDate'));
}

    public function store(Request $request)
    {
        $request->validate([
            'port_id' => 'required|exists:ports,id', // Asegura que el puerto sea obligatorio y válido
            'pickup_date' => 'required|date|after_or_equal:today', // La fecha de recogida es obligatoria y debe ser una fecha válida
            'return_date' => 'required|date|after_or_equal:pickup_date', // La fecha de entrega es obligatoria y debe ser posterior a la de recogida
        ]);

        // Procesar la reserva si la validación pasa
        // ...
    }

    public function getAvailableBoats(Request $request)
{
    $portId = $request->query('port_id');
    $pickupDate = $request->query('pickup_date');
    $returnDate = $request->query('return_date');

    $boats = Boat::where('port_id', $portId)
        ->whereDoesntHave('reservations', function ($query) use ($pickupDate, $returnDate) {
            $query->whereBetween('pickup_date', [$pickupDate, $returnDate])
                  ->orWhereBetween('return_date', [$pickupDate, $returnDate]);
        })->get();

    // Si es una llamada AJAX, devuelve la vista parcial
    if ($request->ajax()) {
        return view('partials.available_boats', compact('boats', 'portId', 'pickupDate', 'returnDate'))->render();
    }

    // Si no, carga la vista completa
    return view('available_boats', compact('boats', 'portId', 'pickupDate', 'returnDate'));
}
public function showAvailableBoatsWithoutDates(Request $request)
{
    $portId = $request->input('port_id');
    $fromWelcome = $request->input('from_welcome'); // Determinar si proviene desde "Más información"

    // Cargar todos los barcos si viene desde "Más información"
    $boats = $fromWelcome ? Boat::where('port_id', $portId)->get() : [];

    return view('available_boats', [
        'boats' => $boats,
        'portId' => $portId,
        'pickupDate' => null,
        'returnDate' => null,
        'fromWelcome' => $fromWelcome,
    ]);
}
public function redirectToPayment($reservationId)
{
    $reservation = Reservation::findOrFail($reservationId);

    // Verificar que el precio total esté calculado
    if ($reservation->total_price <= 0) {
        return redirect()->route('step3')->withErrors(['error' => 'El precio de la reserva no se ha calculado correctamente.']);
    }

    // Redirigir al proceso de pago
    return redirect()->route('payment', ['reservation' => $reservation->id]);
}
public function reserveAndRedirectToPayment(Request $request, $boatId)
{
    // Validar los datos del formulario
    $validated = $request->validate([
        'port_id' => 'required|exists:ports,id',
        'pickup_date' => 'required|date|after:today',
        'return_date' => 'required|date|after:pickup_date',
        'price' => 'required|numeric|min:0',
    ]);

    // Crear la reserva
    $reservation = Reservation::create([
        'boat_id' => $boatId,
        'port_id' => $validated['port_id'],
        'pickup_date' => $validated['pickup_date'],
        'return_date' => $validated['return_date'],
        'total_price' => $validated['price'],
        'name' => $request->input('name', 'Reserva sin nombre'),
        'email' => $request->input('email', 'correo@ejemplo.com'), // Email predeterminado
        'phone' => $request->input('phone', '000000000'),         // Teléfono predeterminado
]);

    // Redirigir a la página de pago con el ID de la reserva
    return redirect()->route('payment', ['reservation' => $reservation->id]);
}
public function getAllReservations($boatId)
{
    $reservations = Reservation::where('boat_id', $boatId)->get();

    // Transformar las reservas al formato esperado por FullCalendar
    $events = $reservations->map(function ($reservation) {
        return [
            'title' => $reservation->available ? 'Disponible' : 'Reservado',
            'start' => $reservation->pickup_date,
            'end' => $reservation->return_date,
            'color' => $reservation->available ? 'green' : 'red',
        ];
    });

    return response()->json($events);
}
public function confirmReservation($reservationId)
{
    $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);

    // Actualizar el estado de la reserva a "pagado"
    $reservation->update(['status' => 'paid']);
    
    Mail::to($reservation->email)->send(new ReservationConfirmationMail(
        $reservation->name,
        $reservation->boat->name,
        $reservation->pickup_date,
        $reservation->departure_time ?? '12:00', // Ajusta si no tienes este campo
        $reservation->port->address
    ));

    return redirect()->route('reservation.confirmed', ['reservation' => $reservationId])
                     ->with('success', __('email.confirmation_sent'));
}
public function showConfirmation($reservationId)
{
    $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);
    return view('pages.confirmation', compact('reservation'));
}

}
