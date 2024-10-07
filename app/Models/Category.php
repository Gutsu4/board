<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // 質問との多対多のリレーション
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_categories');
    }
}
