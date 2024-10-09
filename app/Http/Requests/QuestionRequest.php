<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'course' => 'required|exists:courses,id',
            'content' => 'required|string',
            'author_name' => 'nullable|required_if:is_anonymous,false|string|max:255',
            'is_anonymous' => 'boolean', // boolean として扱う
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.string' => 'タイトルは文字列で入力してください。',
            'title.max' => 'タイトルは最大255文字まで入力可能です。',

            'categories.required' => 'カテゴリーを選択してください。',
            'categories.array' => 'カテゴリーは配列で選択してください。',
            'categories.*.exists' => '選択したカテゴリーは存在しません。',

            'course.required' => 'コースを選択してください。',
            'course.exists' => '選択したコースは存在しません。',

            'content.required' => '内容は必須です。',
            'content.string' => '内容は文字列で入力してください。',

            'author_name.required_if' => '匿名でない場合、投稿者名は必須です。',
            'author_name.string' => '投稿者名は文字列で入力してください。',
            'author_name.max' => '投稿者名は最大255文字まで入力可能です。',

            'is_anonymous.boolean' => '匿名オプションは有効な値で指定してください。',
        ];
    }
}
