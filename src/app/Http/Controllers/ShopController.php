<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Genre;
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

        return view('shop_list', compact('shops', 'areas', 'genres'));
    }

    public function like($shop_id)
    {
        $userId = Auth::id();

        Like::toggleLike($shop_id, $userId);

        return redirect()->route('shop.index');
    }
}
