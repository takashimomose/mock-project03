<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    public function run()
    {
        $likes = [
            [
                'shop_id' => 1,
                'user_id' => 1,
                
            ],
            [
                'shop_id' => 3,
                'user_id' => 1,
                
            ],
            
            [
                'shop_id' => 6,
                'user_id' => 1,
            ],
        ];

        DB::table('likes')->insert($likes);
    }
}
