@extends('layouts.app')

@section('title', '店舗代表者作成')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/owner_create.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="registration-section">
            <div class="card-header">店舗代表者作成</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register.storeOwner') }}" novalidate>
                    @csrf
                    <div class="input-group">
                        <i class="fa-solid fa-user"></i>
                        <input class="form-input" type="text" name="name" value="{{ old('name') }}"
                            placeholder="Username">
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

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
                            作成
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
