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
        Schema::table('sections', function (Blueprint $table) {
            $table->longText('content')->nullable()->after('meta_keywords'); // Campo para el contenido HTML
        });
    }
    
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }
    
};
