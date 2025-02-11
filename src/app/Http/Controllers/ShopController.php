<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');
        $keyword = $request->input('keyword');

        $shops = Shop::searchShops($areaId, $genreId, $keyword);
        $areas = Area::getAreas();
        $genres = Genre::getGenres();

        session()->put('shop_search_params', $request->query());

        return view('shop_list', compact('shops', 'areas', 'genres'));
    }

    public function like(Request $request, $shopId)
    {

        $userId = Auth::id();

        Like::toggleLike($shopId, $userId);

        $queryParams = $request->query();

        if (empty($queryParams)) {
            $queryParams = session()->get('shop_search_params', []);
        }

        $previousUrl = url()->previous();

        $mypageUrl = route('customer.show');

        if ($previousUrl === $mypageUrl) {
            return redirect()->route('customer.show');
        }

        return redirect()->route('shop.index', $queryParams);
    }

    public function detail($shopId)
    {
        $shop = Shop::getShopDetail($shopId);

        return view('shop_detail', compact('shop'));
    }

    public function reserve(ReservationRequest $request)
    {
        $user = Auth::user();

        Reservation::createReservation($request, $user);

        return redirect()->route('shop.done');
    }

    public function done()
    {
        return view('reservation_thanks');
    }
}
