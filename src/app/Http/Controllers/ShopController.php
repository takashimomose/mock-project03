<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 商品一覧取得
        $shops = Shop::getShops();

        // dd($shops);

        // ビューにデータを渡す
        return view('shop_list', compact('shops'));
    }
}
