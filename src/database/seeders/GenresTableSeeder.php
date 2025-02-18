<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            ['name' => '寿司', 'user_id' => 2],
            ['name' => '焼肉', 'user_id' => 2],
            ['name' => '居酒屋', 'user_id' => 2],
            ['name' => 'イタリアン', 'user_id' => 2],
            ['name' => 'ラーメン', 'user_id' => 2],
        ];

        DB::table('genres')->insert($genres);
    }
}
