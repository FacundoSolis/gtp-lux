<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

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
        // Obtener la reserva
        $reservation = Reservation::findOrFail($reservationId);

        // Simula que el pago se ha realizado correctamente
        $reservation->update(['status' => 'paid']); // Asumimos que tienes un campo 'status' en la reserva

        // Redirigir a la página de confirmación con un mensaje de éxito
        return redirect()->route('confirmation', ['reservation' => $reservation->id])
            ->with('success', 'Pago realizado con éxito y reserva confirmada.');
    }
}
