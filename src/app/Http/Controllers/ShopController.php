<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ShopCreateRequest;
use App\Http\Requests\ShopUpdateRequest;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');
        $keyword = $request->input('keyword');

        $shops = Shop::searchShops($areaId, $genreId, $keyword)->get()->map(function ($shop) {
            $shop->likes_user_id = $shop->likes->where('user_id', Auth::id())->pluck('user_id')->first();
            return $shop;
        });

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

    public function create()
    {
        if (!Session::has('errors')) {
            Session::forget('shop_image_temp');
        }

        $areas = Area::getAreas();
        $genres = Genre::getGenres();

        return view('shop_create', compact('areas', 'genres'));
    }

    public function uploadTempImage(Request $request)
    {
        $file = $request->file('shop_image');
        $path = $file->store('shop_images', 'public');

        Session::put('shop_image_temp', $path);

        return response()->json(['success' => true, 'image_url' => asset('storage/' . $path)]);
    }

    public function store(ShopCreateRequest $request)
    {
        $data = $request->only(['name', 'area', 'genre', 'description', 'shop_image']);
        $userId = Auth::id();

        if ($request->hasFile('shop_image')) {
            $path = $request->file('shop_image')->store('shop_images', 'public');
            $data['shop_image'] = $path;
            Session::put('shop_image_temp', $path);
        } elseif (Session::has('shop_image_temp')) {
            $data['shop_image'] = Session::get('shop_image_temp');
        }

        $shop = Shop::createShop([
            'name' => $data['name'],
            'description' => $data['description'],
            'user_id' => $userId,
            'shop_image' => $data['shop_image'],
        ]);

        $shopId = $shop->id;

        $area = Area::createArea($data['area'], $userId, $shopId);
        $genre = Genre::createGenre($data['genre'], $userId, $shopId);

        $shop->update([
            'area_id' => $area->id,
            'genre_id' => $genre->id,
        ]);

        Session::forget('shop_image_temp');

        return redirect()->route('shop.create', ['success' => 'true']);
    }

    public function deleteTempImage()
    {
        Session::forget('shop_image_temp');

        return response()->json(['success' => true]);
    }

    public function list()
    {
        $userId = Auth::id();
        $shops = Shop::searchShops()
            ->paginate(config('const.items_per_page'));

        return view('owner_shop_list', compact('shops'));
    }

    public function edit($shopId)
    {
        if (!Session::has('errors')) {
            Session::forget('shop_image_temp');
        }

        $shop = Shop::getShopDetail($shopId);

        if ($shop->user_id !== Auth::id()) {
            abort(404);
        }

        return view('owner_shop_edit', compact('shop'));
    }

    public function update(ShopUpdateRequest $request, $shopId)
    {
        $shop = Shop::findOrFail($shopId);

        $data = $request->only(['name', 'area', 'genre', 'description', 'shop_image']);

        Area::updateArea($shop->area_id, $data['area']);
        Genre::updateGenre($shop->genre_id, $data['genre']);

        if ($request->hasFile('shop_image')) {
            $path = $request->file('shop_image')->store('shop_images', 'public');
            $data['shop_image'] = $path;
            Session::put('shop_image_temp', $path);
        } elseif (Session::has('shop_image_temp')) {
            $data['shop_image'] = Session::get('shop_image_temp');
        }

        Shop::updateShop($data, $shopId);

        Session::forget('shop_image_temp');

        return redirect()->route('shop.edit', ['shop_id' => $shopId, 'success' => 'true']);
    }

    public function destroy($shopId)
    {
        Shop::deleteShop($shopId);

        return response()->json(['success' => true]);
    }
}
