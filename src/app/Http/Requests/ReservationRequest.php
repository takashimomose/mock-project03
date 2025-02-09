<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => ['required', 'after_or_equal:tomorrow'],
            'time' => ['required'],
            'people' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '予約日を入力してください',
            'date.after_or_equal' => '予約日は明日以降の日付を選択してください',
            'time.required' => '時間を入力してください',
            'people.required' => '人数を入力してください',
            'people.integer' => '人数は数字で入力してください',
            'people.min' => '人数は1以上の数字で入力してください',
        ];
    }
}
