@extends('layouts.app')

@section('title', '会員登録')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="registraion-section">
            <div class="card-header">Registration</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register.store') }}" novalidate>
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
                            登録
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
