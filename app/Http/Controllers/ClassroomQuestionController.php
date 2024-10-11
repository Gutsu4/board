<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Question;

class ClassroomQuestionController extends Controller
{
    public function index(ClassRoom $classroom)
    {
        // Classroom に関連する質問をページネーションで取得
        $questions = $classroom->questions()->orderBy('created_at', 'desc')->paginate(10);
        return view('classroom.index', compact('classroom', 'questions'));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('classroom.index', ['classroom' => auth()->id()])->with('success', '正常に削除が完了しました');
    }
}
