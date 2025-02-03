@extends('layouts.app')

@section('title', '飲食店一覧')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/shop_list.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="shop-list-section">
            @foreach ($shops as $shop)
                <div class="card">
                    <img src="{{ $shop->shop_image }}" alt="仙人">
                    <div class="card-content">
                        <h2>{{ $shop->name }}</h2>
                        <a href="">#{{ $shop->area_name }}</a>
                        <a href="">#{{ $shop->genre_name }}</a>
                        <div class="card-buttons">
                            <button>詳しくみる</button>
                            @if ($shop->likes_user_id)
                                <i class="fa-solid fa-heart" style="color: #EB3223"></i>
                            @else
                                <i class="fa-solid fa-heart"></i>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </main>
@endsection
