@extends('layouts.app')

@section('title', '来店済み')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/owner_visited.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="visited-section">
            <h1>予約確認</h1>
            <p>来店済みです</p>
            <a href="{{ route('reservation.index') }}" class="reservation-list-btn">予約一覧</a>
            @include('components.complete_modal')
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/complete_modal.js') }}"></script>
@endpush
