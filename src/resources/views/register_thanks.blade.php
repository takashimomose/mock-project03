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
                <p class="title">会員登録ありがとうございます</p>
                <p class="message">メールアドレス宛に認証メールを送信しました<br>メールアドレスの認証を行い登録を完了してください</p>
                <a href="{{ route('auth.show') }}">ログインする</a>
            </div>
        </section>
    </main>
@endsection
