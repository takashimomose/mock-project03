<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'shop_id',
        'user_id',
        'reservation_id',
        'rating',
        'comment',
    ];

    public static function createRating($request)
    {
        return self::create($request->all());
    }
}
