<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'shop_id',
        'date',
        'time',
        'people',
    ];

    public static function createReservation($request, $user)
    {
        return self::create([
            'user_id' => $user->id,
            'shop_id' => $request->input('shop_id'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'people' => $request->input('people'),
        ]);
    }
}
