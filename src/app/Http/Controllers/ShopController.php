<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Requests\ShopCreateRequest;
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

    public function show()
    {
        if (!Session::has('errors')) {
            Session::forget('shop_image_temp');
        }

        $areas = Area::getAreas();
        $genres = Genre::getGenres();

        return view('shop_create', compact('areas', 'genres'));
    }

    public function tempUpload(Request $request)
    {
        $file = $request->file('shop_image');
        $path = $file->store('temp_images', 'public');

        Session::put('shop_image_temp', $path);

        return response()->json(['success' => true, 'image_url' => asset('storage/' . $path)]);
    }

    public function store(ShopCreateRequest $request)
    {
        $data = $request->only(['name', 'area', 'genre', 'description', 'shop_image']);

        $data['area_id'] = $data['area'];
        $data['genre_id'] = $data['genre'];
        unset($data['area'], $data['genre']);

        if ($request->hasFile('shop_image')) {
            $path = $request->file('shop_image')->store('shop_images', 'public');
            $data['shop_image'] = $path;
            Session::put('shop_image_temp', $path);
        } elseif (Session::has('shop_image_temp')) {

            $data['shop_image'] = Session::get('shop_image_temp');
        }

        Shop::create($data);

        Session::forget('shop_image_temp');

        return redirect()->route('shop.index');
    }

    public function deleteTempImage()
    {
        Session::forget('shop_image_temp');

        return response()->json(['success' => true]);
    }
}
