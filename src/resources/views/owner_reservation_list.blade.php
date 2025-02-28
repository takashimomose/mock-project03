@extends('layouts.app')

@section('title', '予約一覧')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/owner_reservation_list.css') }}">
@endpush

@section('body-class', 'has-search-filter')

@section('content')
    <main class="wrapper">
        <section class="reservation-list-section">
            <div class="reservation-list-header">
                <h1>予約一覧</h1>
            </div>
            <table class="reservation-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>予約店舗名</th>
                        <th>予約日</th>
                        <th>予約時間</th>
                        <th>人数</th>
                        <th>予約作成日時</th>
                    </tr>
                </thead>
                @foreach ($reservations as $reservation)
                    <tbody>
                        <tr>
                            <td data-label="ID">{{ $reservation->id }}</td>
                            <td data-label="予約店舗名">{{ $reservation->shop_name }}</td>
                            <td data-label="予約日">{{ $reservation->date }}</td>
                            <td data-label="予約時間">{{ $reservation->time }}</td>
                            <td data-label="人数">{{ $reservation->people }}</td>
                            <td data-label="予約作成日時">{{ $reservation->created_at }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div class=pagination>
                {{ $reservations->links() }}
            </div>
        </section>
    </main>
@endsection
