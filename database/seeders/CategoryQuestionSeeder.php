<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoryQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('category_question')->truncate();
        $questionCategories = [
            ['question_id' => 1, 'category_id' => 1],
            ['question_id' => 1, 'category_id' => 2],
            ['question_id' => 2, 'category_id' => 3],
            ['question_id' => 3, 'category_id' => 1],
            ['question_id' => 3, 'category_id' => 4],
            ['question_id' => 4, 'category_id' => 2],
            ['question_id' => 4, 'category_id' => 3],
            ['question_id' => 5, 'category_id' => 1],
            ['question_id' => 5, 'category_id' => 4],
            ['question_id' => 6, 'category_id' => 2],
            ['question_id' => 6, 'category_id' => 3],
            ['question_id' => 7, 'category_id' => 1],
            ['question_id' => 7, 'category_id' => 4],
            ['question_id' => 8, 'category_id' => 2],
            ['question_id' => 8, 'category_id' => 3],
            ['question_id' => 9, 'category_id' => 1],
            ['question_id' => 9, 'category_id' => 4],
            ['question_id' => 10, 'category_id' => 2],
            ['question_id' => 10, 'category_id' => 3],
        ];
        DB::table('category_question')->insert($questionCategories);
        Schema::enableForeignKeyConstraints();
    }
}
