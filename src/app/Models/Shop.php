<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static array $AREA_IDS = [];
    public static array $GENRE_IDS = [];

    public static function initializeConstants()
    {
        self::$AREA_IDS = Area::pluck('name', 'id')->toArray();
        self::$GENRE_IDS = Genre::pluck('name', 'id')->toArray();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public static function searchShops($areaId = null, $genreId = null, $keyword = null)
    {
        if (empty(self::$AREA_IDS) || empty(self::$GENRE_IDS)) {
            self::initializeConstants();
        }

        $query = self::select('id', 'name', 'area_id', 'genre_id', 'shop_image')
            ->with(['likes' => function ($query) {
                $query->select('user_id', 'shop_id');
            }]);

            if ($areaId && $areaId != 'All area') {
                $query->where('area_id', $areaId);
            }
            
            if ($genreId && $genreId != 'All genre') {
                $query->where('genre_id', $genreId);
            }
            
            if ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            }

        return $query->get()->map(function ($shop) {
            $shop->likes_user_id = $shop->likes->pluck('user_id')->first();
            $shop->area_name = self::$AREA_IDS[$shop->area_id];
            $shop->genre_name = self::$GENRE_IDS[$shop->genre_id];
            return $shop;
        });
    }
}
