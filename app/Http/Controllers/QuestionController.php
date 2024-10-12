<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Http\Requests\QuestionRequest;
use App\Models\Answer;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\DB;

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

        // データの取得（作成日時で降順にソート）
        $questions = $query->orderBy('created_at', 'desc')->paginate(10);

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
        // 質問の詳細情報と回答の関連リレーションをロード（回答の数でソート）
        $question->load([
            'categories',
            'classroom',
            'course',
            'answers' => function ($query) {
                $query->orderBy('likes_count', 'desc'); // いいねの多い順にソート
            }
        ]);

        // ビューにデータを渡す
        return view('questions.detail', compact('question'));
    }

    public function create()
    {
        $categories = Category::all();
        $courses = Course::all();

        return view('questions.create', compact('categories', 'courses'));
    }

    public function store(QuestionRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {
            // 新規質問作成
            $question = Question::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'course_id' => $validated['course'],
                'classroom_id' => auth()->id(),
                'is_anonymous' => (bool)$request->input('is_anonymous', false),
                'author_name' => $request->input('is_anonymous') ? null : $validated['author_name']
            ]);

            // カテゴリーのアタッチ
            $question->categories()->attach($validated['categories']);
        });

        return redirect()->route('question.complete');
    }

    public function complete()
    {
        return view('questions.complete');
    }

    public function like(Request $request, Question $question)
    {
        // 「いいね」をインクリメント
        $question->likes_count++;
        $question->save();

        return redirect()->route('question.detail', ['question' => $question->id]);
    }
}
