<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function __construct()
    {
    }

    public function createPayment($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        if ($reservation->total_price === 0) {
            return redirect()->route('payment', $reservation->id)
                ->withErrors(['price_error' => 'El precio total no está calculado correctamente.']);
        }

        return view('reservations.payment', compact('reservation'));
    }

    public function processPayment(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        // Configurar Stripe con la clave secreta
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
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
                'cancel_url' => route('stripe.cancel', ['reservation' => $reservation->id]),
            ]);

            // Redirigir al usuario a la sesión de pago de Stripe
            return redirect($session->url);
        } catch (\Exception $e) {
            return redirect()->route('payment', $reservation->id)
                ->withErrors(['error' => 'Error al procesar el pago con Stripe.']);
        }
    }

    public function cancelPayment($reservationId)
    {
        return redirect()->route('payment', $reservationId)
            ->withErrors(['error' => 'El pago con Stripe fue cancelado.']);
    }
}
