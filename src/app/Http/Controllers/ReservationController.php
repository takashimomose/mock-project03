<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function destroy($reservationId)
    {
        $user = Auth::user();

        Reservation::deleteReservation($reservationId, $user);

        return redirect()->route('customer.show');
    }
}
