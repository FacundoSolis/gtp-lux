<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortsTable extends Migration
{
    public function up()
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('name'); // Nombre del puerto
            $table->timestamps(); // Timestamps (created_at y updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('ports');
    }
}
