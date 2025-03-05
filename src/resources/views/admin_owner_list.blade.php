@extends('layouts.app')

@section('title', '店舗代表者一覧')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin_owner_list.css') }}">
@endpush

@section('body-class', 'has-search-filter')

@section('content')
    <main class="wrapper">
        <section class="owner-list-section">
            <div class="owner-list-header">
                <h1>店舗代表者一覧</h1>
                <a href="{{ route('register.createOwner') }}" class="create-btn">新規作成</a>
            </div>
            <table class="owner-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>メールアドレス</th>
                        <th>役割</th>
                        <th>作成日時</th>
                        <th>アクション</th>
                    </tr>
                </thead>
                @foreach ($owners as $owner)
                    <tbody>
                        <tr>
                            <td data-label="ID">{{ $owner->id }}</td>
                            <td data-label="名前">{{ $owner->name }}</td>
                            <td data-label="メールアドレス">{{ $owner->email }}</td>
                            <td data-label="役割">{{ $owner->role_name }}</td>
                            <td data-label="作成日時">{{ $owner->created_at }}</td>
                            <td data-label="アクション">
                                <button class="delete-btn" data-user-id="{{ $owner->id }}">削除</button>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div class=pagination>
                {{ $owners->links() }}
            </div>
            @include('components.complete_modal')
            @include('components.owner_delete_modal')
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/complete_modal.js') }}"></script>
    <script src="{{ asset('js/owner_delete_modal.js') }}"></script>
@endpush
