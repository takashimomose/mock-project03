@push('css')
    <link rel="stylesheet" href="{{ asset('css/reservation_edit_modal.css') }}">
@endpush

<div id="edit-modal-overlay" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="reservation-edit-form">
            <p>予約内容変更</p>
            <div class="form-group">
                <label class="form-label">Date</label>
                <input class="form-input" id="dateInput" name="date" type="date" value="{{ old('date', $reservation->date) }}"
                    min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" data-default="{{ $reservation->date }}">
                    <div class="error-message" id="dateError"></div>
            </div>

            <div class="form-group">
                <label class="form-label">Time</label>
                <select class="form-select" id="timeSelect" name="time">
                    <option value="{{ old('time', $reservation->time) }}" data-default="{{ $reservation->time }}" selected>{{ $reservation->time }}</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                </select>
                <div class="error-message" id="timeError"></div>
            </div>

            <div class="form-group">
                <label class="form-label">Number</label>
                <select class="form-select" id="peopleSelect" name="people">
                    <option value="{{ old('people', $reservation->people) }}" data-default="{{ $reservation->people }}" selected>{{ $reservation->people }}人</option>
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                    <option value="5">5人</option>
                    <option value="6">6人</option>
                    <option value="7">7人</option>
                    <option value="8">8人</option>
                    <option value="9">9人</option>
                    <option value="10">10人</option>
                </select>
                <div class="error-message" id="peopleError"></div>
            </div>

            <div class="modal-buttons">
                <button id="cancel-edit-btn" class="cancel-btn">キャンセル</button>
                <button id="confirm-edit-btn" class="okay-btn">OK</button>
            </div>
        </div>
    </div>
</div>
