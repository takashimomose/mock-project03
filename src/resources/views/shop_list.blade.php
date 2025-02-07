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
                    <img src="{{ $shop->shop_image }}" alt="{{ $shop->name }}">
                    <div class="card-content">
                        <h2>{{ $shop->name }}</h2>
                        <a href="{{ route('shop.index') }}?area_id={{ $shop->area_id }}">#{{ $shop->area_name }}</a>
                        <a href="{{ route('shop.index') }}?genre_id={{ $shop->genre_id }}">#{{ $shop->genre_name }}</a>
                        <div class="card-buttons">
                            <a href="{{ route('shop.index')}}/{{ $shop->id }}" class="shop-detail">詳しくみる</a>
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
        </section>
    </main>
@endsection
