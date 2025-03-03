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
        'user_id',
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
            'shops.shop_image',
            'shops.created_at',
            'shops.updated_at',
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

        return $query;
    }

    public static function getShopDetail($shopId)
    {
        $shop = self::with('area', 'genre')->findOrFail($shopId);

        $shop->area_name = $shop->area->name;
        $shop->genre_name = $shop->genre->name;

        return $shop;
    }

    public static function createShop(array $data)
    {
        return self::create($data);
    }

    public static function updateShop($data, $shopId)
    {
        $shop = self::findOrFail($shopId);

        return $shop->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'shop_image' => $data['shop_image'] ?? $shop->shop_image,
        ]);
    }

    public static function deleteShop($shopId)
    {
        $shop = self::find($shopId);

        if ($shop) {
            return $shop->delete();
        }

        return false;
    }
}
