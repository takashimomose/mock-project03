<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        $areas = [
            ['name' => '東京都', 'user_id' => 2],
            ['name' => '大阪府', 'user_id' => 2],
            ['name' => '福岡県', 'user_id' => 2],
        ];

        DB::table('areas')->insert($areas);
    }
}
