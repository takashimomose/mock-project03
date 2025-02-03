<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = [
        'area_id',
        'genre_id',
        'name',
        'description',
        'shop_image',
    ];

    const AREA_IDS = [
        1 => '東京',
        2 => '大阪',
        3 => '福岡',
    ];

    const GENRE_IDS = [
        1 => '寿司',
        2 => '焼肉',
        3 => '居酒屋',
        4 => 'イタリアン',
        5 => 'ラーメン',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public static function getShops()
    {
        return self::select('id', 'name', 'area_id', 'genre_id', 'shop_image')
        ->with(['likes' => function ($query) {
            $query->select('user_id', 'shop_id');
        }])
        ->get()
        ->map(function ($shop) {
            $shop->likes_user_id = $shop->likes->pluck('user_id')->first();
            $shop->area_name = self::AREA_IDS[$shop->area_id];
            $shop->genre_name = self::GENRE_IDS[$shop->genre_id];
            return $shop;
        });
    }
}
