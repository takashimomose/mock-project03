<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservationStatus= [
            [
                'id' => 1,
                'name' => '来店なし',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => '来店済み',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('reservation_status')->insert($reservationStatus);
    }
}
