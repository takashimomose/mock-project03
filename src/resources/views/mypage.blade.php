@extends('layouts.app')

@section('title', 'マイページ')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

    @section('content')
        <main class="wrapper">
            <h1 class="username">{{ $userName }}さん</h1>
            <div class="content-container">
                <section class="reservation">
                    <h2 class="section-name">予約状況</h2>
                    @foreach ($reservations as $reservation)
                        <div class="reservation-card">
                            <div class="card-header">
                                <i class="fa-solid fa-clock"></i>
                                <span class="reservation-order">予約{{ $loop->iteration }}</span>
                                <form action="{{ route('reservation.delete', $reservation->id) }}" method="POST"
                                    onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-btn">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                </form>
                            </div>
                            <table class="reservation-table">
                                <tr>
                                    <th>Shop</th>
                                    <td>{{ $reservation->shop_name }}</td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td id="dateTd">{{ $reservation->date }}</td>
                                </tr>
                                <tr>
                                    <th>Time</th>
                                    <td id="timeTd">{{ $reservation->time }}</td>
                                </tr>
                                <tr>
                                    <th>Number</th>
                                    <td id="peopleTd">{{ $reservation->people }}</td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </section>

                <section class="favorite-section">
                    <h2 class="section-name">お気に入り店舗</h2>
                    <div class= "card-group">
                        @foreach ($likedShops as $shop)
                            <div class="card">
                                <img src="{{ $shop->shop_image }}" alt="{{ $shop->name }}">
                                <div class="card-content">
                                    <h2>{{ $shop->name }}</h2>
                                    <a
                                        href="{{ route('shop.index') }}?area_id={{ $shop->area_id }}">#{{ $shop->area_name }}</a>
                                    <a
                                        href="{{ route('shop.index') }}?genre_id={{ $shop->genre_id }}">#{{ $shop->genre_name }}</a>
                                    <div class="card-buttons">
                                        <a href="{{ route('shop.index') }}/{{ $shop->id }}" class="shop-detail">詳しくみる</a>
                                        <form action="{{ route('shop.like', ['shop_id' => $shop->id]) }}" method="POST">
                                            @csrf
                                            <button class="heart">
                                                @if ($shop->likes_user_id)
                                                    <i class="fa-solid fa-heart" style="color: #EB3223"></i>
                                                @else
                                                    <i class="fa-solid fa-heart"></i>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </main>
    @endsection
