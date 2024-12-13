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
        // Verificar si la tabla 'boats' ya existe antes de crearla
        if (!Schema::hasTable('boats')) {
            Schema::create('boats', function (Blueprint $table) {
                $table->id();
                $table->string('name')->comment('Nombre del barco'); // Nombre del barco
                $table->foreignId('port_id')->constrained('ports')->onDelete('cascade')->comment('Relación con puertos'); // Relación con Puertos
                $table->integer('capacity')->comment('Capacidad de personas'); // Capacidad de personas
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar la tabla si existe
        Schema::dropIfExists('boats');
    }
};
