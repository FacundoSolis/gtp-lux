<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ports', function (Blueprint $table) {
            $table->string('location')->nullable()->after('name')->comment('Ubicación del puerto');
        });
    }

    public function down()
    {
        Schema::table('ports', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
};
