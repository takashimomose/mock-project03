<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('areas')->insert(
                [
                    'user_id' => 2,
                    'shop_id' => $i,
                    'name' => $this->getAreaName($i)
                ]
            );
        }
    }

    private function getAreaName($shopId)
    {
        $areas = [
            1 => '東京都',
            2 => '大阪府',
            3 => '福岡県',
            4 => '東京都',
            5 => '福岡県',
            6 => '東京都',
            7 => '大阪府',
            8 => '東京都',
            9 => '大阪府',
            10 => '東京都',
            11 => '大阪府',
            12 => '福岡県',
            13 => '東京都',
            14 => '大阪府',
            15 => '東京都',
            16 => '大阪府',
            17 => '東京都',
            18 => '東京都',
            19 => '福岡県',
            20 => '大阪府'
        ];

        return $areas[$shopId];
    }
}