<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'author_name', 'content', 'is_anonymous'];

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }
}
