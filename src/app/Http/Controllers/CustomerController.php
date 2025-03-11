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

        $reservations = Reservation::getReservation()->where('user_id', $userId);

        $likedShops = Shop::searchShops()
            ->join('likes', 'shops.id', '=', 'likes.shop_id')
            ->where('likes.user_id', $userId)
            ->get();

        return view('mypage', compact('reservations', 'likedShops', 'userName'));
    }
}
