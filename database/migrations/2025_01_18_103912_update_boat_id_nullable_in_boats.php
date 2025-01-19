<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBoatIdNullableInBoats extends Migration
{
    public function up()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->unsignedBigInteger('boat_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->unsignedBigInteger('boat_id')->nullable(false)->change();
        });
    }
}
