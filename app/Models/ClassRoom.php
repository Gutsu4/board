<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ClassRoom extends Authenticatable
{
    use HasFactory;

    protected $table = 'class_rooms';

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'classroom_id');
    }
}
