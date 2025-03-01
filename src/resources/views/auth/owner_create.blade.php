@extends('layouts.app')

@section('title', '店舗代表者作成')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/owner_create.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="registration-section">
            <h1>店舗代表者作成</h1>
            <form method="POST" action="{{ route('register.storeOwner') }}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">店舗代表者名</label>
                    <input class="form-input" type="text" name="name" value="{{ old('name') }}"
                        placeholder="店舗代表者名">
                </div>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input class="form-input" type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
                </div>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="password" class="form-label">パスワード</label>
                    <input class="form-input" type="password" name="password" placeholder="パスワード">
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="form-buttons">
                    <a href="{{ route('owner.index') }}" class="cancel-btn">キャンセル</a>
                    <button type="submit" class="primary-btn">作成</button>
                </div>
            </form>
        </section>
    </main>
@endsection
