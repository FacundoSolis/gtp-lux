<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function payment($reservationId)
    {
            $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);

        return view('reservations.payment', compact('reservation'));
    }


    public function processPayment(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        // Configurar Stripe con la clave secreta
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Crear sesión de pago de Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $reservation->boat->name,
                    ],
                    'unit_amount' => $reservation->total_price * 100, // Convertir a centavos
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('confirmation', ['reservation' => $reservation->id]),
            'cancel_url' => route('payment', ['reservation' => $reservation->id]),
        ]);

        // Redirigir al usuario a la sesión de pago de Stripe
        return redirect($session->url);
        }
        public function confirmation($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        // Actualizar el estado de la reserva a "pagado"
        $reservation->update(['status' => 'paid']);

        return view('reservations.confirmation', compact('reservation'));
    }
    }
