<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    public function run()
    {
        $reservations = [];

        for ($i = 1; $i <= 30; $i++) { 
            $reservations[] = [
                'user_id' => 1,
                'shop_id' => 1,
                'date' => '2025-03-02',
                'time' => '10:00:00',
                'people' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('reservations')->insert($reservations);
    }
}

