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
        Schema::create('date_prices', function (Blueprint $table) {
            $table->id();
            $table->date('start_date'); // Fecha de inicio de la temporada
            $table->date('end_date'); // Fecha de fin de la temporada
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
        Schema::dropIfExists('date_prices');
    }
};
