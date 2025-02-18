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
        'name',
    ];

    public static function getAreas()
    {
        return self::select('id', 'name')
            ->get();
    }

    public static function createArea(string $name, int $userId): Area
    {
        return self::create([
            'name' => $name,
            'user_id' => $userId,
        ]);
    }
}
