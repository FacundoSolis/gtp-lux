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
        $perPage = $request->input('per_page', 25); // Número de resultados por página (por defecto 25)
        $translations = Translation::with('languages')
            ->when($search, function ($query) use ($search) {
                $query->where('key_name', 'like', "%{$search}%")
                      ->orWhere('default_value', 'like', "%{$search}%")
                      ->orWhereHas('languages', function ($query) use ($search) {
                          $query->where('value', 'like', "%{$search}%");
                      });
            })
            ->orderBy('id', 'desc') // Ordenar por las últimas traducciones agregadas
            ->paginate($perPage); // Paginación
        return view('admin.translations.index', compact('translations'));
    }

    public function create()
{
    $languages = config('languages'); // Obtiene los idiomas del archivo de configuración
    return view('admin.translations.create', compact('languages'));
}


    public function store(Request $request)
    {
        $request->validate([
            'key_name' => 'required|string|max:65535|unique:translations,key_name', // Verifica unicidad
            'default_value' => 'required|string|max:65535|unique:translations,key_name', // Validar también contra las claves existentes
        ], [
            'key_name.unique' => 'La clave ya existe en el sistema. Por favor, elige una diferente.',
            'default_value.unique' => 'El valor predeterminado ya existe como clave en el sistema.',
        ]);

        $translation = Translation::create([
            'key_name' => $request->key_name,
            'default_value' => $request->default_value,
            'is_multilanguage' => $request->has('is_multilanguage'),
        ]);

        if ($translation->is_multilanguage && $request->languages) {
            foreach ($request->languages as $lang => $value) {
                if (!empty($value)) {
                    TranslationLanguage::create([
                        'translation_id' => $translation->id,
                        'language_code' => $lang,
                        'value' => $value,
                    ]);
                }
            }
        }
        session()->flash('success', 'Traducción creada correctamente.');
        return redirect()->route('admin.translations.index');
    }

    public function edit($id)
{
    $translation = Translation::with('languages')->findOrFail($id);
    $languages = config('languages'); // Obtiene los idiomas del archivo de configuración
    return view('admin.translations.edit', compact('translation', 'languages'));
}

    public function update(Request $request, $id)
    {
        $translation = Translation::findOrFail($id);

        $request->validate([
            'key_name' => 'required|string|max:65535|unique:translations,key_name,' . $translation->id,
            'default_value' => 'required|string|max:65535', // Máximo permitido para TEXT
        ]);

        $translation->update([
            'key_name' => $request->key_name,
            'default_value' => $request->default_value,
            'is_multilanguage' => $request->has('is_multilanguage'),
        ]);

        if ($translation->is_multilanguage && $request->languages) {
            foreach ($request->languages as $lang => $value) {
                $value = $value ?: ($lang === 'en' ? $request->default_value : null);
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

    public function checkKey(Request $request)
    {
        $keyName = $request->input('key_name');

        $exists = Translation::where('key_name', $keyName)->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'La clave ya existe.' : 'La clave está disponible.'
        ]);
    }
}
