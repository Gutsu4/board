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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->comment('質問ID')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('answer_id')->comment('回答ID')->nullable()->constrained()->onDelete('cascade');
            $table->unsignedInteger('type')->comment('リアクション種別');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
