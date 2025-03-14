<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
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
            ->paginate(config('const.items_per_page'));

        return view('owner_reservation_list', compact('reservations'));
    }

    public function showCheckIn(Request $request)
    {
        $reservationCode = $request->query('reservation_code');

        $reservation = Reservation::getReservation($reservationCode)->first();

        if (!$reservation) {
            abort(404, '予約が見つかりません');
        }

        $shopOwnerId = $reservation->shop->user_id ?? null;

        if ($shopOwnerId !== Auth::id()) {
            abort(403, 'この予約にアクセスする権限がありません');
        }

        if ($reservation->reservation_status_id === Reservation::STATUS_VISITED) {
            return redirect()->route('reservation.visited');
        }

        $userName = $reservation->user->name;

        return view('owner_check_in', compact('reservation', 'userName'));
    }

    public function checkIn(Request $request)
    {
        $reservationCode = $request->input('reservation_code');

        $reservation = Reservation::where('reservation_code', $reservationCode)
            ->first();

        $reservation->update(['reservation_status_id' => Reservation::STATUS_VISITED]);

        return redirect()->route('reservation.visited', ['success' => 'true']);
    }

    public function visited()
    {
        return view('owner_visited');
    }

    public function update(ReservationRequest $request, $reservationId)
    {
        $data = $request->only(['date', 'time', 'people']);

        Reservation::updateReservation($data, $reservationId);

        return response()->json(['success' => true]);
    }
}
