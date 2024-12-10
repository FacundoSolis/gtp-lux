<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la temporada
            $table->date('start_date'); // Fecha de inicio
            $table->date('end_date'); // Fecha de fin
            $table->decimal('price_per_day', 8, 2); // Precio por día
            $table->timestamps(); // Marcas de tiempo (created_at y updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
