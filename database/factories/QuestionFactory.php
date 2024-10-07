<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'classroom_id' => $this->faker->numberBetween(1, 23), // 教室のIDに合わせて適宜範囲を変更
            'course_id' => $this->faker->numberBetween(1, 6), // コースのIDに合わせて適宜範囲を変更
            'title' => $this->faker->realText(20),
            'content' => $this->faker->realText(200),
            'author_name' => $this->faker->name,
            'is_anonymous' => $this->faker->boolean, // true/false で匿名を設定
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
