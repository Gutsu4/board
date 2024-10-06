<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 外部キー制約を無効化
        Schema::disableForeignKeyConstraints();

        // テーブルをクリアしてIDをリセット
        DB::table('questions')->truncate();

        // ダミーデータを生成
        Question::factory(20)->create();

        // 外部キー制約を有効化
        Schema::enableForeignKeyConstraints();
    }
}
