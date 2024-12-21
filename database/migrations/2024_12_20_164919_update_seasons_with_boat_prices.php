<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Actualizar las temporadas para Sunseeker Portofino (boat_id = 3)
        DB::table('seasons')->where('id', 1)->update([
            'boat_id' => 3,
            'start_date' => '2025-01-01',
            'end_date' => '2025-05-31',
            'price_per_day' => 2200,
        ]);

        DB::table('seasons')->where('id', 2)->update([
            'boat_id' => 3,
            'start_date' => '2025-06-01',
            'end_date' => '2025-06-30',
            'price_per_day' => 2500,
        ]);

        DB::table('seasons')->where('id', 3)->update([
            'boat_id' => 3,
            'start_date' => '2025-07-01',
            'end_date' => '2025-08-31',
            'price_per_day' => 3150,
        ]);

        DB::table('seasons')->where('id', 4)->update([
            'boat_id' => 3,
            'start_date' => '2025-09-01',
            'end_date' => '2025-09-30',
            'price_per_day' => 2500,
        ]);

        DB::table('seasons')->where('id', 5)->update([
            'boat_id' => 3,
            'start_date' => '2025-10-01',
            'end_date' => '2025-12-31',
            'price_per_day' => 2200,
        ]);

        // Actualizar las temporadas para Princess V65 (boat_id = 4)
        DB::table('seasons')->where('id', 6)->update([
            'boat_id' => 4,
            'start_date' => '2025-01-01',
            'end_date' => '2025-05-31',
            'price_per_day' => 3400,
        ]);

        DB::table('seasons')->where('id', 7)->update([
            'boat_id' => 4,
            'start_date' => '2025-06-01',
            'end_date' => '2025-06-30',
            'price_per_day' => 3975,
        ]);

        DB::table('seasons')->where('id', 8)->update([
            'boat_id' => 4,
            'start_date' => '2025-07-01',
            'end_date' => '2025-08-31',
            'price_per_day' => 4725,
        ]);

        // Insertar nuevas temporadas para Princess V65
        DB::table('seasons')->insert([
            [
                'name' => 'Media Baja',
                'start_date' => '2025-09-01',
                'end_date' => '2025-09-30',
                'price_per_day' => 3975,
                'boat_id' => 4,
            ],
            [
                'name' => 'Baja',
                'start_date' => '2025-10-01',
                'end_date' => '2025-12-31',
                'price_per_day' => 4725,
                'boat_id' => 4,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir los cambios en las temporadas para Sunseeker Portofino
        DB::table('seasons')->where('id', 1)->update([
            'boat_id' => null,
            'start_date' => '2024-01-01',
            'end_date' => '2024-03-31',
            'price_per_day' => 300,
        ]);

        // Repite para los demás registros según sea necesario...
        DB::table('seasons')->where('id', 6)->update([
            'boat_id' => null,
            'start_date' => '2024-01-01',
            'end_date' => '2024-03-31',
            'price_per_day' => 300,
        ]);

        // Eliminar las temporadas agregadas para Princess V65
        DB::table('seasons')->where('name', 'Media Baja')->where('boat_id', 4)->delete();
        DB::table('seasons')->where('name', 'Baja')->where('boat_id', 4)->delete();
    }
};

