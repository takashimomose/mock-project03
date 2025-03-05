<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public static function getReservation()
    {
        return self::select(
            'reservations.id',
            'users.id as user_id',
            'shops.id as shop_id',
            'shops.name as shop_name',
            'reservations.date',
            'reservations.time',
            'reservations.people'
        )
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('shops', 'reservations.shop_id', '=', 'shops.id')
            ->get()
            ->map(function ($reservation) {
                $reservation->time = Carbon::parse($reservation->time)->format('H:i');
                return $reservation;
            });
    }

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

    public static function deleteReservation($reservationId, $user)
    {
        return self::where('id', $reservationId)
            ->where('user_id', $user->id)
            ->delete();
    }

    public static function getTodayReservations()
    {
        return self::select(
            'reservations.id',
            'users.id as user_id',
            'users.name as user_name',
            'users.email as user_email',
            'shops.name as shop_name',
            'shops.id as shop_id',
            'shops.name as shop_name',
            'reservations.date',
            'reservations.time',
            'reservations.people'
        )
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('shops', 'reservations.shop_id', '=', 'shops.id')
            ->whereDate('reservations.date', today())
            ->get()
            ->map(function ($reservation) {
                $reservation->time = Carbon::parse($reservation->time)->format('H:i');
                return $reservation;
            });
    }
}
