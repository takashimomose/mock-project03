@extends('layouts.app')

@section('title', 'お知らせ作成')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/announcement_create.css') }}">
@endpush

@section('content')
    <main class="wrapper">
        <section class="announcement-create-section">
            <h1>お知らせ作成</h1>
            <form action="{{ route('announcement.send') }}" method="POST">
                @csrf
                <div>
                    <label for="title" class="form-label">タイトル</label>
                    <input class="form-input" type="text" name="title" placeholder="タイトルを入力"
                        value="{{ old('title', $oldData['title'] ?? '') }}">
                </div>
                @error('title')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div>
                    <label for="content" class="form-label">お知らせ内容</label>
                    <textarea class="form-textarea" name="content" placeholder="お知らせ内容を入力">{{ old('content', $oldData['content'] ?? '') }}</textarea>
                </div>
                @error('content')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <div class="form-buttons">
                    <a href="{{ route('owner.index') }}" class="cancel-btn">キャンセル</a>
                    <button type="submit" class="primary-btn" value='submit'>送信</button>
                </div>
            </form>
            @include('components.complete_modal')
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/complete_modal.js') }}"></script>
@endpush
