<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Rating;
use App\Models\Reservation;

class RatingController extends Controller
{
    public function store(RatingRequest $request)
    {
        $request->only(['shop_id', 'user_id', 'reservation_id', 'rating', 'comment']);

        $rating = Rating::createRating($request);

        Reservation::find($request->reservation_id)
            ->update(['rating_id' => $rating->id]);

        return response()->json(['success' => true]);
    }
}
