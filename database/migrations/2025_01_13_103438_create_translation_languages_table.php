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
        Schema::create('translation_languages', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->foreignId('translation_id')->constrained('translations')->onDelete('cascade');
            $table->string('language_code'); // ej: "es", "en"
            $table->text('value');
            $table->timestamps();
        });
    }
    
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translation_languages');
    }
};
