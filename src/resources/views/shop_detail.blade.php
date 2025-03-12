@extends('layouts.app')

@section('title', '飲食店詳細')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="shop-detail-section">
            <div class="shop-info">
                <a href="{{ route('shop.index') }}" class="back-btn">&lt;</a>
                <p class="shop-name">{{ Str::limit($shop->name, config('const.SHOP_DETAIL_SHOP_NAME_LIMIT'), '...') }}</p>
                <img src="{{ $shop->shop_image }}" alt="{{ $shop->name }}" class="shop-image">
                <a href="{{ route('shop.index') }}?area_id={{ $shop->area_id }}">#{{ $shop->area_name }}</a>
                <a href="{{ route('shop.index') }}?genre_id={{ $shop->genre_id }}">#{{ $shop->genre_name }}</a>
                <p>{{ $shop->description }}</p>
            </div>
            <div class="reservation-form">
                <form action="{{ route('shop.reserve') }}" method="POST" novalidate>
                    @csrf
                    <div class="reservation">
                        <h2>予約</h2>
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <input class="date" id="dateInput" name="date" type="date" value=""
                            min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                        @error('date')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <select id="timeSelect" name="time">
                            <option value="" selected>Time</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                        </select>
                        @error('time')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <select id="peopleSelect" name="people">
                            <option value="" selected>Number</option>
                            <option value="1">1人</option>
                            <option value="2">2人</option>
                            <option value="3">3人</option>
                            <option value="4">4人</option>
                            <option value="5">5人</option>
                            <option value="6">6人</option>
                            <option value="7">7人</option>
                            <option value="8">8人</option>
                            <option value="9">9人</option>
                            <option value="10">10人</option>
                        </select>
                        @error('people')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <table class="reservation-table">
                            <tr>
                                <th>Shop</th>
                                <td>{{ Str::limit($shop->name, config('const.SHOP_DETAIL_RESERVATION_SHOP_NAME_LIMIT'), '...') }}</td>
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
                        <p class="error-message">{{ $errors->first('error') }}</p>
                    </div>
                    <button class="reserve-btn">予約する</button>
                </form>
            </div>
        </section>
    </main>
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateInput = document.getElementById("dateInput");

            dateInput.addEventListener("focus", function() {
                this.classList.remove("placeholder");
            });

            dateInput.addEventListener("blur", function() {
                if (!this.value) {
                    this.classList.add("placeholder");
                }
            });
        });
    </script>

    <script>
        const dateInput = document.getElementById('dateInput');
        const timeSelect = document.getElementById('timeSelect');
        const peopleSelect = document.getElementById('peopleSelect');

        const dateTd = document.getElementById('dateTd');
        const timeTd = document.getElementById('timeTd');
        const peopleTd = document.getElementById('peopleTd');

        function updateDisplay() {
            dateTd.textContent = dateInput.value;
            timeTd.textContent = timeSelect.value;
            peopleTd.textContent = peopleSelect.value;
        }

        dateInput.addEventListener('change', updateDisplay);
        timeSelect.addEventListener('change', updateDisplay);
        peopleSelect.addEventListener('change', updateDisplay);

        updateDisplay();
    </script>
@endpush
