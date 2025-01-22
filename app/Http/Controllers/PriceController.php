<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Boat;
use App\Models\Season;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index(Request $request)
    {
        // Validamos que el boat_id esté presente en la URL, pero permitimos que se consulte para cualquier barco
        $boatId = $request->input('boat_id');

        if (!$boatId) {
            // Si no se pasa el boat_id, devolvemos los precios de todos los barcos
            $prices = Price::with('boat', 'seasons')->get();
        } else {
            // Si se pasa el boat_id, solo obtenemos los precios para ese barco específico
            $prices = Price::with('boat', 'seasons')
                ->where('boat_id', $boatId)
                ->get();
        }

        return response()->json($prices);
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
            'end_date' => 'required|date|after_or_equal:start_date',
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
            'end_date' => 'required|date|after_or_equal:start_date',
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
    public function getPricesForBoat(Request $request)
    {
        // Obtenemos el boat_id del parámetro de la solicitud
        $boatId = $request->input('boat_id');

        // Obtener el barco
        $boat = Boat::findOrFail($boatId);

        // Obtener los precios del barco con el boat_id proporcionado
        $prices = Price::where('boat_id', $boatId)->get();

        // Retornamos los precios como respuesta JSON
        return response()->json([
            'boat_name' => $boat->name,
            'prices' => $prices
        ]);
    }
}
