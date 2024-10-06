<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // 質問との一対多のリレーション
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
