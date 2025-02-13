<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'area' => ['required'],
            'genre' => ['required'], 
            'description' => ['required'], 
            'shop_image' => ['required'], 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください',
            'area.required' => '地域を選択してください',
            'genre.required' => 'ジャンルを選択してください',
            'description.required' => '店舗概要を入力してください',
            'shop_image.required' => '店舗画像をアップロードしてください',
        ];
    }
}
