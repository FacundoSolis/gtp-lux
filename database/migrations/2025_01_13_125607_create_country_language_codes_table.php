<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('country_language_codes', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 2)->unique(); // El código de país sigue siendo corto (2 caracteres)
            $table->text('country_name'); // Cambiar a text para eliminar el límite
            $table->string('language_code', 5)->unique(); // El código de idioma sigue siendo corto (5 caracteres)
            $table->text('language_name'); // Cambiar a text para eliminar el límite
            $table->text('flag')->nullable(); // Cambiar a text para eliminar el límite
            $table->timestamps();
        });
        
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_language_codes');
    }
};
