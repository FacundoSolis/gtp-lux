<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CountryLanguageCode;
use Illuminate\Http\Request;

class CountryLanguageCodeController extends Controller
{
    public function index()
    {
        $codes = CountryLanguageCode::all();
        return view('admin.codes.index', compact('codes'));
    }

    public function edit($id)
{
    // Buscar el código por su ID
    $code = CountryLanguageCode::findOrFail($id);

    // Retornar la vista de edición con los datos del código
    return view('admin.codes.edit', compact('code'));
}

    public function create()
    {
        return view('admin.codes.create');
    }

    public function store(Request $request)
{
    $languages = config('languages'); // Obtenemos los idiomas configurados
    $request->validate([
        'country_code' => 'required|string|max:2|unique:country_language_codes',
        'country_name' => 'required|string',
        'language_code' => 'required|string|max:5|unique:country_language_codes',
        'language_name' => 'required|string',
        'flag' => [
            'required',
            function ($attribute, $value, $fail) use ($languages) {
                // Verificamos si la bandera existe en la configuración
                if (!array_key_exists($value, $languages)) {
                    $fail("La bandera para '{$value}' no existe en la configuración de idiomas.");
                }
            },
        ],
    ]);

    CountryLanguageCode::create([
        'country_code' => $request->input('country_code'),
        'country_name' => $request->input('custom_country') ?: $request->input('country_name'),
        'language_code' => $request->input('language_code'),
        'language_name' => $request->input('custom_language') ?: $request->input('language_name'),
        'flag' => $request->input('flag'),
    ]);

    return redirect()->route('admin.codes.index')->with('success', 'Código agregado exitosamente.');
}



public function update(Request $request, $id)
{
    $languages = config('languages'); // Obtenemos los idiomas configurados
    $code = CountryLanguageCode::findOrFail($id);

    $request->validate([
        'country_code' => 'required|string|max:2|unique:country_language_codes,country_code,' . $code->id,
        'country_name' => 'required|string',
        'language_code' => 'required|string|max:5|unique:country_language_codes,language_code,' . $code->id,
        'language_name' => 'required|string',
        'flag' => [
            'required',
            function ($attribute, $value, $fail) use ($languages) {
                if (!array_key_exists($value, $languages)) {
                    $fail("La bandera para '{$value}' no existe en la configuración de idiomas.");
                }
            },
        ],
    ]);

    // Actualizamos el registro
    $code->update([
        'country_code' => $request->input('country_code'),
        'country_name' => $request->input('country_name'),
        'language_code' => $request->input('language_code'),
        'language_name' => $request->input('language_name'),
        'flag' => $request->input('flag'),
    ]);

    return redirect()->route('admin.codes.index')->with('success', 'Código actualizado correctamente.');
}

public function destroy($id)
{
    CountryLanguageCode::destroy($id);
    return redirect()->route('admin.codes.index')->with('success', 'Código eliminado correctamente.');
}

}
