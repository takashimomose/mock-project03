<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'max:40'],
            'content' => ['required', 'max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは:max文字以内で入力してください',
            'content.required' => 'お知らせ内容を入力してください',
            'content.max' => 'お知らせ内容は:max文字以内で入力してください',
        ];
    }
}
