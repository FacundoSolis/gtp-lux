<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceModifierToBoats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->decimal('price_modifier', 8, 2)->default(0)->after('capacity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->dropColumn('price_modifier');
        });
    }
}
