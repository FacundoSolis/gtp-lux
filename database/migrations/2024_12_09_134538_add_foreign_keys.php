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
            $table->foreignId('boat_id')->constrained('boats')->onDelete('cascade'); // Relación con Barcos
        });
        Schema::table('date_prices', function (Blueprint $table) {
            $table->foreignId('boat_id')->constrained('boats')->onDelete('cascade'); // Relación con Barcos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
