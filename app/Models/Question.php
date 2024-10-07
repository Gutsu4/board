<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'classroom_id', 'author_name', 'title', 'content', 'is_anonymous'];

    // コースとのリレーション
    public function course(): belongsTo
    {
        return $this->belongsTo(Course::class);
    }

    // カテゴリーとのリレーション (多対多の場合)
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_question');
    }

    public function classroom(): belongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function answers(): hasMany
    {
        return $this->hasMany(Answer::class);
    }
}
