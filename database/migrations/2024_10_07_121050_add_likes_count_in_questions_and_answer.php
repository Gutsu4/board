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
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedInteger('likes_count')->default(0)->after('is_anonymous');
        });
        Schema::table('answers', function (Blueprint $table) {
            $table->unsignedInteger('likes_count')->default(0)->after('is_anonymous');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dorpColumn('likes_count');
        });
        Schema::table('answers', function (Blueprint $table) {
            $table->dorpColumn('likes_count');
        });
    }
};
