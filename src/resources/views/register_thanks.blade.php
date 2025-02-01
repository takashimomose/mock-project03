@extends('layouts.app')

@section('title', '会員登録完了')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/register_thanks.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="register-thanks-section">
            <div class="card-header"></div>
            <div class="card-body">
                <p>会員登録ありがとうございます</p>
                <a href="{{ route('auth.show') }}">ログインする</a>
            </div>
        </section>
    </main>
@endsection
