<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boat_id')->constrained('boats')->onDelete('cascade'); // Relación con Barcos
            $table->date('start_date'); // Fecha de inicio
            $table->date('end_date'); // Fecha de fin
            $table->decimal('price_per_day', 8, 2); // Precio por día
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
};
