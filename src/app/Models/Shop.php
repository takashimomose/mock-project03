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

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public static function searchShops($areaId = null, $genreId = null, $keyword = null)
    {
        $query = self::select(
            'shops.id',
            'shops.name',
            'shops.area_id',
            'areas.name as area_name',
            'shops.genre_id',
            'genres.name as genre_name',
            'shops.shop_image'
        )
            ->join('areas', 'shops.area_id', '=', 'areas.id')
            ->join('genres', 'shops.genre_id', '=', 'genres.id')
            ->with(['likes' => function ($query) {
                $query->select('user_id', 'shop_id');
            }])
            ->orderBy('shops.id', 'asc');

        if ($areaId && $areaId != 'All area') {
            $query->where('shops.area_id', $areaId);
        }

        if ($genreId && $genreId != 'All genre') {
            $query->where('shops.genre_id', $genreId);
        }

        if ($keyword) {
            $query->where('shops.name', 'LIKE', "%{$keyword}%");
        }

        return $query->get()->map(function ($shop) {
            $shop->likes_user_id = $shop->likes->where('user_id', Auth::id())->pluck('user_id')->first();
            return $shop;
        });
    }

    public static function getShopDetail($shopId)
    {
        $shop = self::with('area', 'genre')->findOrFail($shopId);

        $shop->area_name = $shop->area->name;
        $shop->genre_name = $shop->genre->name;

        return $shop;
    }
}
