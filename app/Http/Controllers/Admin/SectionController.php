<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('admin.sections.index', compact('sections'));
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'params' => 'nullable|json',
        ]);

        $section->update($validated);

        return redirect()->route('admin.sections.index')->with('success', 'Sección actualizada correctamente.');
    }

    public function deploy(Section $section)
    {
        // Lógica para desplegar la sección
        return redirect()->route('admin.sections.index')->with('success', 'Sección desplegada correctamente.');
    }
}
