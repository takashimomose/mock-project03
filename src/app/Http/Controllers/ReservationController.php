<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    private const ITEMS_PER_PAGE = 20;

    public function destroy($reservationId)
    {
        $user = Auth::user();

        Reservation::deleteReservation($reservationId, $user);

        return redirect()->route('customer.show');
    }

    public function index()
    {
        $userId = Auth::id();

        $shopIds = Shop::where('user_id', $userId)->pluck('id');

        $reservations = Reservation::getReservations()
            ->whereIn('reservations.shop_id', $shopIds)
            ->paginate(self::ITEMS_PER_PAGE);

        return view('owner_reservation_list', compact('reservations'));
    }
}
