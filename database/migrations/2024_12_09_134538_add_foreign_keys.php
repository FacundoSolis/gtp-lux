<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('boats', function (Blueprint $table) {
            if (!Schema::hasColumn('boats', 'boat_id')) {
                $table->unsignedBigInteger('boat_id')->after('id');
            }
        });
        Schema::table('date_prices', function (Blueprint $table) {
            if (!Schema::hasColumn('date_prices', 'boat_id')) {
                $table->unsignedBigInteger('boat_id')->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
