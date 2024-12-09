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
        Schema::table('boats', function (Blueprint $table) {
            // Cambiar el tipo de la columna 'id' a unsignedBigInteger
            $table->unsignedBigInteger('id', true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boats', function (Blueprint $table) {
            // Revertir el cambio a 'int(11)' si se hace rollback
            $table->integer('id')->change();
        });
    }
};
