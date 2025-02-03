<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 検索条件の取得
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');
        $keyword = $request->input('keyword');

        $shops = Shop::searchShops($areaId, $genreId, $keyword);
        $areas = Area::getAreas();
        $genres = Genre::getGenres();

        return view('shop_list', compact('shops', 'areas', 'genres'));
    }
}
