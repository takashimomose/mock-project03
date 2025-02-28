@extends('layouts.app')

@section('title', '店舗一覧')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/owner_shop_list.css') }}">
@endpush

@section('body-class', 'has-search-filter')

@section('content')
    <main class="wrapper">
        <section class="shop-list-section">
            <div class="shop-list-header">
                <h1>店舗一覧</h1>
                <a href="{{ route('shop.create') }}" class="create-btn">新規作成</a>
            </div>
            <table class="shop-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>店舗名</th>
                        <th>地域</th>
                        <th>ジャンル</th>
                        <th>作成日時</th>
                        <th>更新日時</th>
                        <th>アクション</th>
                    </tr>
                </thead>
                @foreach ($shops as $shop)
                    <tbody>
                        <tr>
                            <td data-label="ID">{{ $shop->id }}</td>
                            <td data-label="店舗名">{{ $shop->name }}</td>
                            <td data-label="地域">{{ $shop->area_name }}</td>
                            <td data-label="ジャンル">{{ $shop->genre_name }}</td>
                            <td data-label="作成日時">{{ $shop->created_at }}</td>
                            <td data-label="更新日時">{{ $shop->updated_at }}</td>
                            <td data-label="アクション">
                                <a href="{{ route('shop.edit', ['shop_id' => $shop->id]) }}" class="edit-btn">詳細</a>
                                <button class="delete-btn" data-shop-id="{{ $shop->id }}">削除</button>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div class=pagination>
                {{ $shops->links() }}
            </div>
            @include('components.delete_modal')
        </section>
    </main>
@endsection

@push('scripts')
<script src="{{ asset('js/delete_modal.js') }}"></script>
@endpush
