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

        session()->put('shop_search_params', $request->query());

        return view('shop_list', compact('shops', 'areas', 'genres'));
    }

    public function like(Request $request, $shop_id)
    {

        $userId = Auth::id();

        Like::toggleLike($shop_id, $userId);

        $queryParams = $request->query();

        if (empty($queryParams)) {
            $queryParams = session()->get('shop_search_params', []);
        }

        return redirect()->route('shop.index', $queryParams);
    }

    public function detail($shop_id)
    {
        $shop = Shop::getShopDetail($shop_id);
// dd($shop);

        return view('shop_detail', compact('shop'));
    }
}
