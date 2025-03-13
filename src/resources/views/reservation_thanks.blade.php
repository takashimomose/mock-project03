@extends('layouts.app')

@section('title', '予約完了')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/reservation_thanks.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="reservation-thanks-section">
            <div class="card-header"></div>
            <div class="card-body">
                <p>予約ありがとうございます</p>
                <a href="{{ route('shop.index') }}">戻る</a>
            </div>
        </section>
    </main>
@endsection
