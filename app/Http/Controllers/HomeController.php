<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home', [
            'totalReservations' => Reservation::count(),
            'totalPayments' => Payment::sum('amount'),
            'totalUsers' => User::count(),
        ]);
    }
}
