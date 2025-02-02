@extends('layouts.app')

@section('title', '飲食店一覧')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/shop_list.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="register-thanks-section">
                <div class="card">
                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="仙人">
                    <div class="card-content">
                        <h2>仙人</h2>
                        <p>#東京都 #寿司</p>
                        <button>詳しくみる</button>
                        <span class="heart">❤️</span>
                    </div>
                </div>
                <div class="card">
                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="牛助">
                    <div class="card-content">
                        <h2>牛助</h2>
                        <p>#大阪府 #焼肉</p>
                        <button>詳しくみる</button>
                        <span class="heart">🤍</span>
                    </div>
                </div>
                <div class="card">
                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="仙人">
                    <div class="card-content">
                        <h2>仙人</h2>
                        <p>#東京都 #寿司</p>
                        <button>詳しくみる</button>
                        <span class="heart">❤️</span>
                    </div>
                </div>
                <div class="card">
                    <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg" alt="牛助">
                    <div class="card-content">
                        <h2>牛助</h2>
                        <p>#大阪府 #焼肉</p>
                        <button>詳しくみる</button>
                        <span class="heart">🤍</span>
                    </div>
                </div>
        </section>
    </main>
@endsection
