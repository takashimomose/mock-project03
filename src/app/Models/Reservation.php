<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
        'reservation_code',
        'reservation_status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function getTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }

    public static function getReservation()
    {
        return self::select(
            'users.id as user_id',
            'shops.id as shop_id',
            'shops.name as shop_name',
            'reservations.id',
            'reservations.date',
            'reservations.time',
            'reservations.people',
            'reservations.reservation_code',
            'reservations.reservation_status_id',
            'reservation_status.name as reservation_status'
        )
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('shops', 'reservations.shop_id', '=', 'shops.id')
            ->join('reservation_status', 'reservations.reservation_status_id', '=', 'reservation_status.id')
            ->get()
            ->map(function ($reservation) {
                $reservation->time = Carbon::parse($reservation->time)->format('H:i');
                $localIp = config('app.local_ip'); // 設定値を取得
                $reservation->qrcode_url = $localIp . '/owner/check-in?reservation_code=' . $reservation->reservation_code;

                return $reservation;
            });
    }

    const STATUS_NO_SHOW = 1;
    const STATUS_VISITED = 2;

    public static function createReservation($request, $user)
    {
        return self::create([
            'user_id' => $user->id,
            'shop_id' => $request->input('shop_id'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'people' => $request->input('people'),
            'reservation_code' => Str::uuid(),
            'reservation_status_id' => self::STATUS_NO_SHOW,
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

    public static function getReservations()
    {
        $query = self::select(
            'reservations.id',
            'reservations.date',
            'reservations.time',
            'reservations.people',
            'reservation_status.name as reservation_status_name',
            'shops.name as shop_name',
            'users.name as user_name',
            'reservations.created_at'
        )
            ->join('shops', 'reservations.shop_id', '=', 'shops.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('reservation_status', 'reservations.reservation_status_id', '=', 'reservation_status.id')
            ->orderBy('reservations.id', 'asc');

        return $query;
    }
}
