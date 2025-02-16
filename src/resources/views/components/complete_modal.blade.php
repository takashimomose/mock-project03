@push('css')
    <link rel="stylesheet" href="{{ asset('css/complete_modal.css') }}">
@endpush

<div id="modal-overlay" class="modal" style="display: none;">
    <div class="modal-content">
        <p>完了しました！</p>
        <button id="close-modal" class="okay-btn">OK</button>
    </div>
</div>