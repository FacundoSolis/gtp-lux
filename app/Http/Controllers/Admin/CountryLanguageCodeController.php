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

    public function create()
    {
        return view('admin.codes.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'country_code' => 'required|string|max:2|unique:country_language_codes',
        'country_name' => 'required|string',
        'language_code' => 'required|string|max:5|unique:country_language_codes',
        'language_name' => 'required|string',
        'flag' => [
            'nullable',
            function ($attribute, $value, $fail) {
                if ($value && !file_exists(public_path("path_to_flags/{$value}.png"))) {
                    $fail("La bandera '{$value}.png' no existe en la carpeta 'path_to_flags'.");
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
    $code = CountryLanguageCode::findOrFail($id);

    $request->validate([
        'flag' => [
            'nullable',
            function ($attribute, $value, $fail) {
                if ($value && !file_exists(public_path("path_to_flags/{$value}.png"))) {
                    $fail("La bandera '{$value}.png' no existe en la carpeta 'path_to_flags'.");
                }
            },
        ],
        'country_code' => 'required|string|max:2|unique:country_language_codes,country_code,' . $code->id,
        'country_name' => 'required|string',
        'language_code' => 'required|string|max:5|unique:country_language_codes,language_code,' . $code->id,
        'language_name' => 'required|string',
    ]);

    // Actualizar el registro
    $code->update([
        'country_code' => $request->input('country_code'),
        'country_name' => $request->input('custom_country') ?: $request->input('country_name'),
        'language_code' => $request->input('language_code'),
        'language_name' => $request->input('custom_language') ?: $request->input('language_name'),
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
