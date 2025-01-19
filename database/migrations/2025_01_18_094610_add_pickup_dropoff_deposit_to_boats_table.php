<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPickupDropoffDepositToBoatsTable extends Migration
{
    public function up()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->time('pickup_time')->nullable()->comment('Hora de recogida');
            $table->time('dropoff_time')->nullable()->comment('Hora de entrega');
            $table->decimal('deposit', 10, 2)->nullable()->comment('Fianza requerida');
        });
    }

    public function down()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->dropColumn(['pickup_time', 'dropoff_time', 'deposit']);
        });
    }
}

