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
                        <div class="image-preview"
                            style="display: {{ Session::has('shop_image_temp') ? 'flex' : 'none' }};">
                            @if (Session::has('shop_image_temp'))
                                <img id="preview" src="{{ asset('storage/' . Session::get('shop_image_temp')) }}"
                                    alt="Image Preview">
                            @else
                                <img id="preview" src="#" alt="Image Preview" style="display: none;">
                            @endif
                        </div>
                        <label for="shop-image" class="shop-image-upload">
                            画像を選択する
                        </label>
                        <input type="file" id="shop-image" name="shop_image" accept="image/*" style="display: none;"
                            onchange="previewImage(event)">
                    </div>
                </div>
                @error('shop_image')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="form-buttons">
                    <button type="submit" class="cancel-btn" value="cancel">キャンセル</button>
                    <button type="submit" class="primary-btn" value='submit'>作成</button>
                </div>
            </form>
        </section>
    </main>
    {{-- 画像アップロード後のプレビュー表示 --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                const imagePreviewWrapper = document.querySelector('.image-preview');

                preview.src = reader.result;
                preview.style.display = 'block';
                imagePreviewWrapper.style.display = 'flex';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
