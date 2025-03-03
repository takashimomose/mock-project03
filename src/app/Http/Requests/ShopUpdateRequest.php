<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:20'],
            'area' => ['required', 'max:10'],
            'genre' => ['required', 'max:10'],
            'description' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください',
            'name.max' => '店舗名は:max文字以内で入力してください',
            'area.required' => '地域を入力してください',
            'area.max' => '地域は:max文字以内で入力してください',
            'genre.required' => 'ジャンルを入力してください',
            'genre.max' => 'ジャンルは:max文字以内で入力してください',
            'description.required' => '店舗概要を入力してください',
            'description.max' => '店舗概要は:max文字以内で入力してください',
        ];
    }
}
