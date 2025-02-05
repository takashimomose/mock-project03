@extends('layouts.app')

@section('title', '飲食店詳細')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="shop-detail-section">
            <div class="shop-info">
                <a href="{{ route('shop.index') }}" class="back-btn">&lt;</a> <p class="shop-name">{{ $shop->name }}</p>
                <img src="{{ $shop->shop_image }}" alt="{{ $shop->name }}" class="shop-image">
                <a href="{{ route('shop.index') }}?area_id={{ $shop->area_id }}">#{{ $shop->area_name }}</a>
                <a href="{{ route('shop.index') }}?genre_id={{ $shop->genre_id }}">#{{ $shop->genre_name }}</a>
                <p>{{ $shop->description }}</p>
            </div>
            <div class="reservation-form">
                <form>
                    @csrf
                    <div class="reservation">
                        <h2>予約</h2>
                        <input id="dateInput" type="date" value="2025-03-01">
                        <select id="timeSelect">
                            <option>11:00</option>
                            <option>12:00</option>
                            <option>13:00</option>
                            <option>14:00</option>
                            <option>15:00</option>
                            <option>16:00</option>
                            <option>17:00</option>
                            <option>18:00</option>
                            <option>19:00</option>
                            <option>20:00</option>
                            <option>21:00</option>
                        </select>
                        <select id="peopleSelect">
                            <option>1人</option>
                            <option>2人</option>
                            <option>3人</option>
                            <option>4人</option>
                            <option>5人</option>
                            <option>6人</option>
                            <option>7人</option>
                            <option>8人</option>
                            <option>9人</option>
                            <option>10人</option>
                        </select>
                        <table class="reservation-table">
                            <tr>
                              <th>Shop</th>
                              <td>{{ $shop->name }}</td>
                            </tr>
                            <tr>
                              <th>Date</th>
                              <td id="dateTd"></td>
                            </tr>
                            <tr>
                              <th>Time</th>
                              <td id="timeTd"></td>
                            </tr>
                            <tr>
                              <th>Number</th>
                              <td id="peopleTd"></td>
                            </tr>
                          </table>
                    </div>
                    <button class="reserve-btn">予約する</button>
                </form>
            </div>
        </section>
    </main>
@endsection
