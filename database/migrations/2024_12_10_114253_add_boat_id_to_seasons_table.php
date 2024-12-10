<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoatIdToSeasonsTable extends Migration
{
    public function up()
{
    Schema::table('seasons', function (Blueprint $table) {
        $table->foreignId('boat_id')->nullable()->constrained('boats')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('seasons', function (Blueprint $table) {
        $table->dropForeign(['boat_id']);
        $table->dropColumn('boat_id');
    });
}
}
