<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function show()
    {
        $userId = Auth::id();

        $userName = Auth::user()->name;

        $reservations = Reservation::getReservation()->filter(function ($reservation) use ($userId) {
            return $reservation->user_id === $userId;
        });

        $likedShops = Shop::searchShops()->filter(function ($shop) use ($userId) {
            return $shop->likes_user_id === $userId;
        });

        return view('mypage', compact('reservations', 'likedShops', 'userName'));
    }
}
