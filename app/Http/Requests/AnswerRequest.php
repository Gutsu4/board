<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'question_id' => 'required|exists:questions,id',
            'content' => 'required|string',
            // 'nullable' を追加して匿名の場合はバリデーションをスキップ
            'author_name' => 'nullable|required_if:is_anonymous,false|string|max:255',
            'is_anonymous' => 'nullable|in:on,1,false', // チェックボックスの可能な値に対応
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => '回答内容は必須です。',
            'content.string' => '回答内容は文字列で入力してください。',
            'author_name.required_if' => '匿名でない場合、投稿者名は必須です。',
            'author_name.string' => '投稿者名は文字列で入力してください。',
            'author_name.max' => '投稿者名は最大255文字まで入力可能です。',
            'is_anonymous.in' => '匿名オプションは有効な値で指定してください。',
        ];
    }
}
