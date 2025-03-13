<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RatingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rating' => ['integer', 'between:1,5'],
            'comment' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'rating.between' => '五段階評価を選択してください',
            'comment.required' => 'コメントを入力してください',
            'comment.max' => 'コメントは:max文字以内で入力してください',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
}
