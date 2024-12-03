<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Boat;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::with('boat')->get(); // Incluye la relación con barcos
        return view('prices.index', compact('prices'));
    }

    public function create()
    {
        $boats = Boat::all();
        return view('prices.create', compact('boats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'boat_id' => 'required|exists:boats,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Corrección en validación
            'price_per_day' => 'required|numeric|min:0',
        ]);

        Price::create($data);
        return redirect()->route('prices.index')->with('success', 'Precio agregado con éxito.');
    }

    public function edit(Price $price)
    {
        $boats = Boat::all();
        return view('prices.edit', compact('price', 'boats'));
    }

    public function update(Request $request, Price $price)
    {
        $data = $request->validate([
            'boat_id' => 'required|exists:boats,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Corrección en validación
            'price_per_day' => 'required|numeric|min:0',
        ]);

        $price->update($data);
        return redirect()->route('prices.index')->with('success', 'Precio actualizado con éxito.');
    }

    public function destroy(Price $price)
    {
        $price->delete();
        return redirect()->route('prices.index')->with('success', 'Precio eliminado con éxito.');
    }
}
