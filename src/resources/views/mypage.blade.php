@extends('layouts.app')

@section('title', 'マイページ')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

    @section('content')
        <main class="wrapper">
            <h1 class="username">testさん</h1>
            <div class="content-container">
                <section class="reservation">
                    <h2 class="section-name">予約状況</h2>
                    <div class="reservation-card">
                        <div class="card-header">
                            <i class="fa-solid fa-clock"></i>
                            <span class="reservation-order">予約1</span>
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                        <table class="reservation-table">
                            <tr>
                                <th>Shop</th>
                                <td>ラーメン大学</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td id="dateTd">2025-02-20</td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td id="timeTd">12:00</td>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <td id="peopleTd">3</td>
                            </tr>
                        </table>
                    </div>
                    <div class="reservation-card">
                        <div class="card-header">
                            <i class="fa-solid fa-clock"></i>
                            <span class="reservation-order">予約1</span>
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                        <table class="reservation-table">
                            <tr>
                                <th>Shop</th>
                                <td>ラーメン大学</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td id="dateTd">2025-02-20</td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td id="timeTd">12:00</td>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <td id="peopleTd">3</td>
                            </tr>
                        </table>
                    </div>
                </section>

                <section class="favorite-section">
                    <h2 class="section-name">お気に入り店舗</h2>
                    <div class= "card-group">
                        <div class="card">
                            <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg" alt="">
                            <div class="card-content">
                                <h2>ラーメン大学1</h2>
                                <a href="">#</a>
                                <a href="">#</a>
                                <div class="card-buttons">
                                    <a href="" class="shop-detail">詳しくみる</a>
                                    <form action="" method="POST">
                                        @csrf
                                        <button class="heart">
                                            <i class="fa-solid fa-heart" style="color: #EB3223"></i>
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg" alt="">
                            <div class="card-content">
                                <h2>ラーメン大学2</h2>
                                <a href="">#</a>
                                <a href="">#</a>
                                <div class="card-buttons">
                                    <a href="" class="shop-detail">詳しくみる</a>
                                    <form action="" method="POST">
                                        @csrf
                                        <button class="heart">
                                            <i class="fa-solid fa-heart" style="color: #EB3223"></i>
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <img src="https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg" alt="">
                            <div class="card-content">
                                <h2>ラーメン大学3</h2>
                                <a href="">#</a>
                                <a href="">#</a>
                                <div class="card-buttons">
                                    <a href="" class="shop-detail">詳しくみる</a>
                                    <form action="" method="POST">
                                        @csrf
                                        <button class="heart">
                                            <i class="fa-solid fa-heart" style="color: #EB3223"></i>
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    @endsection
