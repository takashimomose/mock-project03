@extends('layouts.app')

@section('title', '飲食店一覧')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/shop_list.css') }}">
@endpush

@section('body-class', 'has-search-filter')

@section('content')
    <main class="wrapper">
        <section class="shop-list-section">
            @foreach ($shops as $shop)
                <div class="card">
                    @if (filter_var($shop->shop_image, FILTER_VALIDATE_URL))
                        <img id="preview" src="{{ $shop->shop_image }}" alt="Image Preview">
                    @else
                        <img id="preview" src="{{ Storage::url($shop->shop_image) }}" alt="Image Preview">
                    @endif
                    <div class="card-content">
                        <h2>{{ Str::limit($shop->name, config('const.SHOP_LIST_SHOP_NAME_LIMIT'), '...') }}</h2>
                        <a href="{{ route('shop.index') }}?area_id={{ $shop->area_id }}">#{{ Str::limit($shop->area_name, config('const.SHOP_LIST_AREA_NAME_LIMIT'), '...') }}</a>
                        <a href="{{ route('shop.index') }}?genre_id={{ $shop->genre_id }}">#{{ Str::limit($shop->genre_name, config('const.SHOP_LIST_GENRE_NAME_LIMIT'), '...') }}</a>
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
        </section>
    </main>
@endsection
