<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'shop_id',
        'user_id',
    ];

    public static function toggleLike($shopId, $userId)
    {
        $like = self::where('shop_id', $shopId)
            ->where('user_id', $userId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            self::create([
                'shop_id' => $shopId,
                'user_id' => $userId,
            ]);
        }
    }
}
