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
    Schema::table('boats', function (Blueprint $table) {
        $table->json('description')->nullable(); // Agregar la columna 'description' de tipo JSON
    });
}

public function down()
{
    Schema::table('boats', function (Blueprint $table) {
        $table->dropColumn('description');
    });
}
};
