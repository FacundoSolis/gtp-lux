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
                $table->unsignedBigInteger('port_id')->comment('Relación con puertos'); // Relación con Puertos
                $table->integer('capacity')->comment('Capacidad de personas'); // Capacidad de personas
                $table->timestamps();
            });

            // Agregar la clave foránea después de verificar si la tabla 'ports' existe
            if (Schema::hasTable('ports')) {
                Schema::table('boats', function (Blueprint $table) {
                    $table->foreign('port_id')->references('id')->on('ports')->onDelete('cascade');
                });
            }
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
