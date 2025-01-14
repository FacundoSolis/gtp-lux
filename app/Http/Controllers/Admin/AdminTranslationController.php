<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use App\Models\TranslationLanguage;
use Illuminate\Http\Request;

class AdminTranslationController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $translations = Translation::with('languages')
        ->when($search, function ($query) use ($search) {
            $query->where('key_name', 'like', "%{$search}%")
                  ->orWhere('default_value', 'like', "%{$search}%")
                  ->orWhereHas('languages', function ($query) use ($search) {
                      $query->where('value', 'like', "%{$search}%");
                  });
        })
        ->get();

    return view('admin.translations.index', compact('translations'));
}


    public function create()
    {
        $languages = ['es' => 'Español', 'en' => 'Inglés', 'fr' => 'Francés', 'de' => 'Alemán', 'it' => 'Italiano'];
        return view('admin.translations.create', compact('languages'));
    }

    public function store(Request $request)
{
    $request->validate([
        'key_name' => 'required|string|unique:translations,key_name',
        'default_value' => 'required|string',
    ]);

    $translation = Translation::create([
        'key_name' => $request->key_name,
        'default_value' => $request->default_value,
        'is_multilanguage' => $request->has('is_multilanguage'),
    ]);

    if ($translation->is_multilanguage && $request->languages) {
        foreach ($request->languages as $lang => $value) {
            // Validar que el valor no sea nulo
            if (!empty($value)) {
                TranslationLanguage::create([
                    'translation_id' => $translation->id,
                    'language_code' => $lang,
                    'value' => $value,
                ]);
            }
        }
    }
    session()->flash('success', 'Traducción actualizada correctamente.');
    return redirect()->route('admin.translations.index');
}


    public function edit($id)
    {
        $translation = Translation::with('languages')->findOrFail($id);
        $languages = ['es' => 'Español', 'en' => 'Inglés', 'fr' => 'Francés', 'de' => 'Alemán', 'it' => 'Italiano'];
        return view('admin.translations.edit', compact('translation', 'languages'));
    }

    public function update(Request $request, $id)
    {
        $translation = Translation::findOrFail($id);
    
        // Validación
        $request->validate([
            'key_name' => 'required|string|max:255|unique:translations,key_name,' . $translation->id,
            'default_value' => 'required|string|max:255',
        ]);
    
        // Actualizar la traducción principal
        $translation->update([
            'key_name' => $request->key_name,
            'default_value' => $request->default_value,
            'is_multilanguage' => $request->has('is_multilanguage'),
        ]);
    
        // Actualizar traducciones por idioma
        if ($translation->is_multilanguage && $request->languages) {
            foreach ($request->languages as $lang => $value) {
                $value = $value ?: ($lang === 'en' ? $request->default_value : null); // Inglés por defecto
                if (!empty($value)) {
                    $translation->languages()->updateOrCreate(
                        ['language_code' => $lang],
                        ['value' => $value]
                    );
                }
            }
        }
    
        session()->flash('success', 'Traducción actualizada correctamente.');
        return redirect()->route('admin.translations.index');
    }
    public function destroy($id)
    {
        Translation::destroy($id);
        return redirect()->route('admin.translations.index')->with('success', 'Traducción eliminada.');
    }

    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids', []);
    Translation::whereIn('id', $ids)->delete();

    return redirect()->route('admin.translations.index')->with('success', 'Traducciones eliminadas correctamente.');
}
public function exportTranslations()
{
    $translations = Translation::with('languages')->get();

    $data = $translations->map(function ($translation) {
        return [
            'key' => $translation->key_name,
            'default_value' => $translation->default_value,
            'is_multilanguage' => $translation->is_multilanguage,
            'languages' => $translation->languages->pluck('value', 'language_code')->toArray(),
        ];
    });

    return response()->json($data);
}

}
