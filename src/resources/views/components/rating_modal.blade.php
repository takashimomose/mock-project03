@push('css')
    <link rel="stylesheet" href="{{ asset('css/rating_modal.css') }}">
@endpush

<div id="rating-modal-overlay" class="rating-modal" style="display: none;">
    <div class="rating-modal-content">
        <div class="rating-edit-form">
            <p>店舗評価</p>
            <div class="form-group">
                <label class="form-label">五段階評価</label>
                <div class="rating">
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div>
                <p>評価: <span id="rating-value">0</span> / 5</p>
                <input type="hidden" id="ratingValue" name="rating" data-default="0" value="0">
            </div>
            <div class="error-message" id="ratingError"></div>

            <div class="form-group">
                <label class="form-label">コメント</label>
                <textarea id="commentTextarea" class="form-textarea" name="comment" placeholder="コメントを入力" data-default="{{ old('comment', $oldData['comment'] ?? '') }}">{{ old('comment', $oldData['comment'] ?? '') }}</textarea>
            </div>
            <div class="error-message" id="commentError"></div>

            <div class="rating-modal-buttons">
                <button id="cancel-rating-btn" class="cancel-btn">キャンセル</button>
                <button id="confirm-rating-btn" class="okay-btn">OK</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/rating.js') }}"></script>
@endpush
