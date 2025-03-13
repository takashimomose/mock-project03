@push('css')
    <link rel="stylesheet" href="{{ asset('css/complete_modal.css') }}">
@endpush

<div id="modal-overlay" class="modal" style="display: none;">
    <div class="modal-content">
        <p>完了しました！</p>
        <button id="close-modal" class="close-btn">閉じる</button>
    </div>
</div>
