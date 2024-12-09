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
    Schema::table('reservations', function (Blueprint $table) {
        $table->dropColumn('num_persons'); // Eliminar la columna num_persons
    });
}

public function down()
{
    Schema::table('reservations', function (Blueprint $table) {
        $table->integer('num_persons'); // Volver a agregar la columna si haces rollback
    });
    }
};
