<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Requiere autenticación
    }
    public function index(Request $request)
    {
        return view('admin.payments.index'); // Asegúrate de que esta vista exista
    }
}
