@extends('layouts.app')

@section('title', '管理者ログイン')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin_login.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="login-section">
            <div class="card-header">Admin Login</div>
            <div class="card-body">
                <form method="POST" action="{{ route('auth.storeAdmin') }}" novalidate>
                    @csrf
                    <div class="input-group">
                        <i class="fa-solid fa-envelope"></i>
                        <input class="form-input" type="email" name="email"
                            value="{{ old('email') }}"placeholder="Email">
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <div class="input-group">
                        <i class="fa-solid fa-lock"></i>
                        <input class="form-input" type="password" name="password" placeholder="Password">
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <div class="input-group">
                        <button type="submit" class="primary-btn">
                            ログイン
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
