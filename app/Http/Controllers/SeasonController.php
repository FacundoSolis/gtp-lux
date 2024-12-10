<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Mostrar la lista de temporadas.
     */
    public function index()
    {
        $seasons = Season::all();
        return view('seasons.index', compact('seasons'));
    }

    /**
     * Mostrar el formulario para crear una nueva temporada.
     */
    public function create()
    {
        return view('seasons.create');
    }

    /**
     * Guardar una nueva temporada.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price_per_day' => 'required|numeric|min:0',
            'boat_id' => 'required|exists:boats,id', // Validar relación con barco
        ]);

        Season::create($data);
        return redirect()->route('seasons.index')->with('success', 'Temporada creada con éxito.');
    }

    /**
     * Mostrar el formulario de edición de una temporada.
     */
    public function edit(Season $season)
    {
        return view('seasons.edit', compact('season'));
    }

    /**
     * Actualizar los datos de una temporada existente.
     */
    public function update(Request $request, Season $season)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        $season->update($data);
        return redirect()->route('seasons.index')->with('success', 'Temporada actualizada con éxito.');
    }

    /**
     * Eliminar una temporada.
     */
    public function destroy(Season $season)
    {
        $season->delete();
        return redirect()->route('seasons.index')->with('success', 'Temporada eliminada con éxito.');
    }
}
