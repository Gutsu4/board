<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\ClassRoom;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionSearchController extends Controller
{
    public function showSearchForm(Request $request)
    {
        $query = Question::query();

        // カテゴリーで絞り込み
        if ($request->filled('category.blade.php')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category); // 'categories.id' を明示的に指定
            });
        }

        // キーワードで絞り込み
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('content', 'LIKE', '%' . $request->keyword . '%');
            });
        }

        // 期間で絞り込み
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }

        // 拠点で絞り込み
        if ($request->filled('classroom')) {
            $query->where('classroom_id', $request->classroom);
        }

        // コースで絞り込み
        if ($request->filled('course')) {
            $query->where('course_id', $request->course);
        }

        // 検索結果の取得
        $questions = $query->paginate(10);

        return view('questions.search', [
            'questions' => $questions,
            'categories' => Category::all(),
            'courses' => Course::all(),
            'classRooms' => ClassRoom::all(),
        ]);
    }
}
