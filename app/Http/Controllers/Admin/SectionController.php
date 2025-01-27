<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Asegúrate de importar la clase base Controller


class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_name' => 'required|string|max:255|unique:sections,section_name',
            'template_name' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        Section::create($request->all());

        return redirect()->route('admin.sections.index')->with('success', 'Sección creada correctamente.');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'content' => 'nullable|string',
            'params' => 'nullable|json',
        ]);

        $section->update($request->all());

        return redirect()->route('admin.sections.index')->with('success', 'Sección actualizada correctamente.');
    }

    public function show($section_name)
{
    $section = Section::where('section_name', $section_name)
        ->where('is_deployed', true) // Solo mostrar secciones desplegadas
        ->firstOrFail();

    return view('template.dynamic-template', [
        'meta_title' => $section->meta_title,
        'meta_description' => $section->meta_description,
        'meta_keywords' => $section->meta_keywords,
        'section' => $section,
    ]);
}
    public function deploy(Section $section)
{
    // Cambiar el estado de la sección a "deployada"
    $section->update(['is_deployed' => true]);

    return redirect()->route('admin.sections.index')->with('success', 'Sección desplegada correctamente.');
}

}



