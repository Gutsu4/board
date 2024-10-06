<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the questions is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'class_room' => ['required'], // 教室IDのバリデーション
            'password' => ['required', 'string'], // パスワードのバリデーション
        ];
    }

    public function messages()
    {
        return [
            'class_room.required' => '教室を選択してください。',
            'password.required' => 'パスワードを入力してください。',
            'password.string' => 'パスワードは文字列である必要があります。',
        ];
    }
}
