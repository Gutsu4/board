<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use App\Models\ClassRoom;

// Classroomモデルをインポート

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        // 基本のクエリ
        $query = Question::query();

        // カテゴリーでの検索
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        // コースでの検索
        if ($request->filled('course')) {
            $query->where('course_id', $request->course);
        }

        // 教室での検索
        if ($request->filled('classroom')) {
            $query->where('classroom_id', $request->classroom);
        }

        // データの取得（ページネーション）
        $questions = $query->paginate(10);

        // ビューへのデータ渡し
        return view('questions.index', [
            'questions' => $questions,
            'categories' => Category::all(),
            'courses' => Course::all(),
            'classRooms' => ClassRoom::all(),
        ]);
    }

    public function detail(Question $question)
    {
        // 質問の詳細情報を取得
        $question->load('categories', 'classRoom', 'user');
        // ビューにデータを渡す
        return view('questions.detail', compact('question'));
    }

    public function create()
    {
        // カテゴリー一覧を取得
        $categories = Category::all();
        // ビューにデータを渡す
        return view('questions.create', compact('categories'));
    }
}
