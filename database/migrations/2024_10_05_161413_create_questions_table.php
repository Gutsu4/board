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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->comment('教室ID')->constrained('class_rooms')->onDelete('cascade');
            $table->string('author_name')->comment('質問者名');
            $table->text('title')->comment('質問タイトル');
            $table->text('content')->comment('質問内容');
            $table->boolean('is_anonymous')->default(false)->comment('匿名フラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
