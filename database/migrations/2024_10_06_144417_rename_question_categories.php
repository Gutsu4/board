<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('question_categories', 'category_question');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('category_question', 'question_categories');
    }
};
