<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClassRoomSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            CategoryQuestionSeeder::class
        ]);

        // 開発環境用のダミーデータを生成
        if (app()->environment('local')) {
            $this->call([
                QuestionSeeder::class
            ]);
        }
    }
}
