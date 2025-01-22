<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('section_name'); // Nombre de la sección (ej. Inicio, Reservas, Barcos)
            $table->string('template_name'); // Nombre de la plantilla (ej. default, global)
            $table->string('meta_title')->nullable(); // Título de la página
            $table->text('meta_description')->nullable(); // Meta descripción
            $table->text('meta_keywords')->nullable(); // Palabras clave
            $table->json('params')->nullable(); // Parámetros adicionales (ej. multilenguaje)
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
