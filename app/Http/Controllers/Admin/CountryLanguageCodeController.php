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
            'flag' => 'nullable|string|max:10',
        ]);

        CountryLanguageCode::create($request->all());
        return redirect()->route('admin.codes.index')->with('success', 'Código agregado exitosamente.');
    }
}
