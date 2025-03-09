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
                                    onsubmit="return confirm('予約をキャンセルしますか？');">
                                    @csrf
                                    @method('DELETE')
                                    @if ($reservation->reservation_status_id == \App\Models\Reservation::STATUS_NO_SHOW)
                                        <button class="delete-btn">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </button>
                                    @endif
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
                                <tr>
                                    <th>Status</th>
                                    <td id="reservationStatusTd">{{ $reservation->reservation_status }}</td>
                                </tr>
                            </table>
                            @if ($reservation->reservation_status_id == \App\Models\Reservation::STATUS_NO_SHOW)
                                <div class="qr-code">{!! QrCode::size(200)->generate($reservation->qrcode_url)->toHtml() !!}</div>
                                <button class="edit-btn" data-reservation-id="{{ $reservation->id }}"
                                    data-reservation-date="{{ $reservation->date }}"
                                    data-reservation-time="{{ $reservation->time }}"
                                    data-reservation-people="{{ $reservation->people }}"
                                    data-reservation-user-id="{{ $reservation->user_id }}">
                                    予約内容変更
                                </button>
                            @elseif (!$reservation->rating_id)
                                <button class="rating-btn" data-rating-reservation-id="{{ $reservation->id }}"
                                    data-rating-user-id="{{ $reservation->user_id }}"
                                    data-rating-shop-id="{{ $reservation->shop_id }}">評価する</button>
                            @endif
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
                                        <a href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}"
                                            class="shop-detail">詳しくみる</a>
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
                    @if ($reservations->isNotEmpty())
                        @include('components.reservation_edit_modal')
                        @include('components.rating_modal')
                    @endif
                </section>
            </div>
        </main>
    @endsection

    @push('scripts')
        <script src="{{ asset('js/reservation_edit_modal.js') }}"></script>
        <script src="{{ asset('js/rating_modal.js') }}"></script>
    @endpush
