@extends('layouts.app')

@section('title', '予約確認')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/owner_check_in.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="check-in-section">
            <h1>予約確認</h1>
            <label for="" class="form-label">予約コード</label>
            <p>{{ $reservation->reservation_code }}</p>
            <label for="" class="form-label">予約者</label>
            <p>{{ $userName }}</p>
            <label for="" class="form-label">日時</label>
            <p>{{ $reservation->date }} {{ $reservation->time }}</p>
            <label for="" class="form-label">人数</label>
            <p>{{ $reservation->people }}人</p>
            <form action="{{ route('reservation.checkIn') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="reservation_code" value="{{ $reservation->reservation_code }}">
                <div class="form-buttons">
                    <a href="{{ route('shop.list') }}" class="cancel-btn">キャンセル</a>
                    <button type="submit" class="primary-btn" value='submit'>チェックイン</button>
                </div>
            </form>
        </section>
    </main>
@endsection
