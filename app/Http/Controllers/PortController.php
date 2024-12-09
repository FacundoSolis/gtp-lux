<?php

namespace App\Http\Controllers;

use App\Models\Port;

class PortController extends Controller
{
    public function index()
    {
        // Retorna una lista de todos los puertos
        $ports = Port::all();
        return view('ports.index', compact('ports'));
    }
}
