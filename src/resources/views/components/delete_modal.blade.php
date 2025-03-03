@push('css')
    <link rel="stylesheet" href="{{ asset('css/delete_modal.css') }}">
@endpush

<div id="delete-modal-overlay" class="modal" style="display: none;">
    <div class="modal-content">
        <p>本当に削除しますか？</p>
        <div class="modal-buttons">
            <button id="cancel-delete-btn" class="cancel-btn">キャンセル</button>
            <button id="confirm-delete-btn" class="okay-btn">OK</button>
        </div>
    </div>
</div>
