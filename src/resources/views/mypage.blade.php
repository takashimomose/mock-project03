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
                                <p class="reservation-order">予約{{ $loop->iteration }}</p>
                                <form action="{{ route('reservation.delete', $reservation->id) }}" method="POST"
                                    onsubmit="return confirm('予約をキャンセルしますか？');">
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
                                    <td>{{ Str::limit($reservation->shop_name, 24, '...') }}</td>
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
                                <tr>
                                    <th>Status</th>
                                    <td id="reservationStatusTd">{{ $reservation->reservation_status }}</td>
                                </tr>
                            </table>
                            @if ($reservation->reservation_status_id == \App\Models\Reservation::STATUS_NO_SHOW)
                                <div class="qr-code">{!! QrCode::size(200)->generate($reservation->qrcode_url)->toHtml() !!}</div>
                            @endif
                        </div>
                    @endforeach
                </section>

                <section class="favorite-section">
                    <h2 class="section-name">お気に入り店舗</h2>
                    <div class= "card-group">
                        @foreach ($likedShops as $likedshop)
                            <div class="card">
                                <img src="{{ $likedshop->shop_image }}" alt="{{ $likedshop->name }}">
                                <div class="card-content">
                                    <h2>{{ Str::limit($likedshop->name, 18, '...') }}</h2>
                                    <a
                                        href="{{ route('shop.index') }}?area_id={{ $likedshop->area_id }}">#{{ $likedshop->area_name }}</a>
                                    <a
                                        href="{{ route('shop.index') }}?genre_id={{ $likedshop->genre_id }}">#{{ $likedshop->genre_name }}</a>
                                    <div class="card-buttons">
                                        <a href="{{ route('shop.detail', ['shop_id' => $likedshop->id]) }}"
                                            class="shop-detail">詳しくみる</a>
                                        <form action="{{ route('shop.like', ['shop_id' => $likedshop->id]) }}" method="POST">
                                            @csrf
                                            <button class="heart">
                                                <i class="fa-solid fa-heart" style="color: #EB3223"></i>
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
