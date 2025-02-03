<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmationMail;
use Illuminate\Support\Facades\Log;



class PaymentController extends Controller
{
    public function payment(Request $request, $reservationId = null)
    {
            $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);
            // Obtener fechas de la URL o usar las de la reserva
            $pickupDate = $request->input('pickup_date', $reservation->pickup_date);
            $returnDate = $request->input('return_date', $reservation->return_date);

            return view('reservations.payment', compact('reservation', 'pickupDate', 'returnDate'));
        }
    public function processPayment(Request $request, $reservationId = null)
        {
            \Log::info('ProcessPayment Invocado', [
            'reservationId' => $reservationId,
            'request' => $request->all(),
        ]);
    
        if (!$reservationId) {
            return redirect()->route('form')->with('error', 'Completa el paso anterior.');
        }
    
        $reservation = Reservation::findOrFail($reservationId);
    
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
        ]);
    
        $reservation->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => 'processing',
        ]);

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
    return view('reservations.payment', compact('reservation'));
    }
    public function confirmation($reservationId)
{
    // Cargar la reserva con las relaciones necesarias
    $reservation = Reservation::with('boat', 'port')->findOrFail($reservationId);

    // Actualizamos el estado a 'paid'
    $reservation->update(['status' => 'paid']);

    // Si aún no se ha enviado el correo, lo enviamos
    if (!$reservation->email_sent) {
        try {
            // Envío usando el objeto completo de la reserva
            Mail::to($reservation->email)->send(new ReservationConfirmationMail($reservation));
            
            // Actualizamos el flag para indicar que ya se envió el correo
            $reservation->update(['email_sent' => true]);
        } catch (\Exception $e) {
            Log::error('Error al enviar correo de confirmación: ' . $e->getMessage());
        }
    }

    // Retornamos la vista de confirmación con un mensaje flash
    return view('reservations.confirmation', compact('reservation'))
           ->with('success', __('email.confirmation_sent'));
}

}
