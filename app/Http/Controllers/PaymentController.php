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
        $reservation = Reservation::findOrFail($reservationId);

        // Verificar si el precio total está presente
        if ($reservation->total_price === 0) {
            return redirect()->route('step3')->withErrors(['price_error' => 'El precio total no está calculado correctamente.']);
        }

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
}
