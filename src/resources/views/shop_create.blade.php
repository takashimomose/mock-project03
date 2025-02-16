@extends('layouts.app')

@section('title', '店舗作成')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/shop_create.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="shop-create-section">
            <h1>店舗の作成</h1>
            <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">店舗名</label>
                    <input class="form-input" type="text" name="name" placeholder=""
                        value="{{ old('name', $oldData['name'] ?? '') }}">
                </div>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="area" class="form-label">地域</label>
                    <div class="area-buttons">
                        @foreach ($areas as $area)
                            <input type="radio" id="area_{{ $area->id }}" name="area" value="{{ $area->id }}"
                                {{ old('area') == $area->id ? 'checked' : '' }}>
                            <label class="area-label" for="area_{{ $area->id }}">{{ $area->name }}</label>
                        @endforeach
                    </div>
                </div>
                @error('area')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="genre" class="form-label">ジャンル</label>
                    <div class="genre-buttons">
                        @foreach ($genres as $genre)
                            <input type="radio" id="genre_{{ $genre->id }}" name="genre"
                                value="{{ $genre->id }}" {{ old('genre') == $genre->id ? 'checked' : '' }}>
                            <label class="genre-label" for="genre_{{ $genre->id }}">{{ $genre->name }}</label>
                        @endforeach
                    </div>
                </div>
                @error('genre')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="description" class="form-label">店舗概要</label>
                    <textarea class="form-textarea" name="description">{{ old('description', $oldData['description'] ?? '') }}</textarea>
                </div>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="shop-image-group">
                    <div class="shop-image-wrapper">
                        @if (Session::has('shop_image_temp'))
                            <div class="image-preview" style="display: flex;">
                                <img id="preview" src="{{ asset('storage/' . Session::get('shop_image_temp')) }}"
                                    alt="Image Preview">
                            </div>
                        @else
                            <div class="image-preview" style="display: none;">
                                <img id="preview" src="#" alt="Image Preview">
                            </div>
                        @endif

                        <div class="image-buttons">
                            <label for="shop-image" class="shop-image-upload">画像を選択</label>
                            <input type="file" id="shop-image" name="shop_image" accept="image/*" style="display: none;">

                            @if (Session::has('shop_image_temp'))
                                <button type="button" class="delete-btn" id="delete-btn">画像を削除</button>
                            @else
                                <button type="button" class="delete-btn" id="delete-btn"
                                    style="display: none;">画像を削除</button>
                            @endif
                        </div>
                    </div>
                </div>
                @error('shop_image')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="form-buttons">
                    <a href="" class="cancel-btn">キャンセル</a>
                    <button type="submit" class="primary-btn" value='submit'>作成</button>
                </div>
            </form>
            @include('components.complete_modal')
        </section>
    </main>
@endsection

@push('scripts')
<script src="{{ asset('js/shop_image_upload.js') }}"></script>
<script src="{{ asset('js/complete_modal.js') }}"></script>
@endpush
