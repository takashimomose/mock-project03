<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('genres')->insert(
                [
                    'user_id' => 2,
                    'shop_id' => $i,
                    'name' => $this->getGenreName($i)
                ]
            );
        }
    }

    private function getGenreName($shopId)
    {
        $genres = [
            1 => '寿司',
            2 => '焼肉',
            3 => '居酒屋',
            4 => 'イタリアン',
            5 => 'ラーメン',
            6 => '焼肉',
            7 => 'イタリアン',
            8 => 'ラーメン',
            9 => '居酒屋',
            10 => '寿司',
            11 => '焼肉',
            12 => '焼肉',
            13 => '居酒屋',
            14 => '寿司',
            15 => 'ラーメン',
            16 => '居酒屋',
            17 => '寿司',
            18 => '焼肉',
            19 => 'イタリアン',
            20 => '寿司'
        ];

        return $genres[$shopId];
    }
}
