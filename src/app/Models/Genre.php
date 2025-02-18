<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';

    protected $fillable = [
        'user_id',
        'name',
    ];

    public static function getGenres()
    {
        return self::select('id', 'name')
            ->get();
    }

    public static function createGenre(string $name, int $userId): Genre
    {
        return self::create([
            'name' => $name,
            'user_id' => $userId,
        ]);
    }
}
