<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del cliente
            $table->string('email'); // Email del cliente
            $table->string('phone'); // Teléfono del cliente
            $table->integer('num_persons'); // Número de personas
            $table->foreignId('boat_id')->constrained('boats')->onDelete('cascade'); // Relación con Barcos
            $table->foreignId('port_id')->constrained('ports')->onDelete('cascade'); // Relación con Puertos
            $table->date('pickup_date'); // Fecha de recogida
            $table->date('return_date'); // Fecha de entrega
            $table->decimal('total_price', 10, 2)->default(0); // Precio total
            $table->timestamps(); // Marcas de tiempo
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
