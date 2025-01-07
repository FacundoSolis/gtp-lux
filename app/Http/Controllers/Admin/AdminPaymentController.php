<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Payment;



use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Requiere autenticación
    }
    public function index()
    {
        // Carga todos los pagos desde la base de datos
        $payments = Payment::with('reservation')->get(); // Asegúrate de tener la relación 'reservation' en el modelo Payment.

        // Devuelve la vista con los datos de los pagos
        return view('admin.payments.index', compact('payments'));
    }
}