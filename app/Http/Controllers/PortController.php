<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;


class PortController extends Controller
{
    public function index()
    {
        // Retorna una lista de todos los puertos
        $ports = Port::all();
        return view('admin.ports.index', compact('ports'));
    }
    public function create()
{
    return view('admin.ports.create');
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Port::create($validated);

    return redirect()->route('ports.index')->with('success', 'Puerto creado con éxito.');
}

    public function edit(Port $port)
    {
        return view('admin.ports.edit', compact('port'));
    }

    public function update(Request $request, Port $port)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $port->update($validated);

    return redirect()->route('ports.index')->with('success', 'Puerto actualizado con éxito.');
}

    public function destroy(Port $port)
    {
        $port->delete();

        return redirect()->route('ports.index')->with('success', 'Puerto eliminado con éxito.');
}

}
