<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        $areas = [
            ['name' => '東京都'],
            ['name' => '大阪府'],
            ['name' => '福岡県'],
        ];

        DB::table('areas')->insert($areas);
    }
}
