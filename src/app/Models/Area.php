<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';

    protected $fillable = [
        'user_id',
        'shop_id',
        'name',
    ];

    public static function getAreas()
    {
        return self::select('id', 'name')
            ->get();
    }

    public static function createArea(string $name, int $userId, int $shopId): Area
    {
        return self::create([
            'name' => $name,
            'user_id' => $userId,
            'shop_id' => $shopId, // 既に作成されたShopのIDを設定
        ]);
    }

    public static function updateArea(int $areaId, string $name)
    {
        self::where('id', $areaId)->update(['name' => $name]);
    }
}
