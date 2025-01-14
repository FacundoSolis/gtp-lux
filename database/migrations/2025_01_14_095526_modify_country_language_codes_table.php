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
        Schema::table('country_language_codes', function (Blueprint $table) {
            $table->text('country_name')->change(); // Cambiar a text
            $table->text('language_name')->change(); // Cambiar a text
            $table->text('flag')->nullable()->change(); // Cambiar a text
        });
    }
    
    public function down()
    {
        Schema::table('country_language_codes', function (Blueprint $table) {
            $table->string('country_name')->change(); // Revertir a string
            $table->string('language_name')->change(); // Revertir a string
            $table->string('flag', 10)->nullable()->change(); // Revertir a string
        });
    }
    
};
