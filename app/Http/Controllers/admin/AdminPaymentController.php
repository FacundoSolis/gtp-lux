<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index()
    {
        return view('admin.payments.index'); // Asegúrate de que esta vista exista
    }
}
