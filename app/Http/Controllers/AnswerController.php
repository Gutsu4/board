<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(AnswerRequest $request)
    {
        $validated = $request->validated();
        // 新規回答作成
        $answer = new Answer();
        $answer->question_id = $validated['question_id'];
        $answer->content = $validated['content'];

        // チェックボックスの値をtrue/falseに変換
        $answer->is_anonymous = (bool)$request->input('is_anonymous', false);

        // 匿名の場合はauthor_nameをnullに設定
        if ($answer->is_anonymous) {
            $answer->author_name = null;
        } else {
            $answer->author_name = $validated['author_name'];
        }

        $answer->save();

        return redirect()->route('question.detail', ['question' => $request->question_id]);
    }

    // AnswerController.php
    public function like(Request $request, Answer $answer)
    {
        // 「いいね」をインクリメント
        $answer->likes_count++;
        $answer->save();

        // JSONレスポンスで「いいね」の数を返す
        return redirect()->route('question.detail', ['question' => $answer->question_id]);
    }
}
