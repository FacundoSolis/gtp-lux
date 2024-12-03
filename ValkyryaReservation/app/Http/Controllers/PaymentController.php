<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        // Aquí puedes simular un pago exitoso
        return redirect()->route('confirmation')->with('success', 'Pago realizado con éxito.');
    }
}

