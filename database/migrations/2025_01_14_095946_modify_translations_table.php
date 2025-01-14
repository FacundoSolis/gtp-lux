<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->text('key_name')->change(); // Cambiar a tipo text
            $table->text('default_value')->change(); // Cambiar a tipo text
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->string('key_name', 255)->change(); // Revertir a string con 255 caracteres
            $table->string('default_value', 255)->change(); // Revertir a string con 255 caracteres
        });
    }
};

