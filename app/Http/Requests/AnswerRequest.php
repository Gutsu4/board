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
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // チェックボックスの値をbooleanに変換
        $this->merge([
            'is_anonymous' => $this->boolean('is_anonymous'),
        ]);
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
            'author_name' => 'nullable|required_if:is_anonymous,false|string|max:255',
            'is_anonymous' => 'boolean', // boolean として扱う
        ];
    }

    public function messages(): array
    {
        return [
            'question_id.required' => '質問IDは必須です。',
            'question_id.exists' => '指定された質問が存在しません。',
            'content.required' => '回答内容は必須です。',
            'content.string' => '回答内容は文字列で入力してください。',
            'author_name.required_if' => '匿名でない場合、投稿者名は必須です。',
            'author_name.string' => '投稿者名は文字列で入力してください。',
            'author_name.max' => '投稿者名は最大255文字まで入力可能です。',
            'is_anonymous.boolean' => '匿名オプションは有効な値で指定してください。',
        ];
    }
}
