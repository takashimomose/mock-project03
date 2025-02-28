<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateShopsTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('shops')
                ->where('id', $i)
                ->update([
                    'area_id' => $i,
                    'genre_id' => $i,
                ]);
        }
    }
}
