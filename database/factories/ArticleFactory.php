<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug,
            'title' => $this->faker->words(5, true),
            'preview' => $this->faker->sentence(3),
            'body' => $this->faker->text,
            'owner_id' => User::inRandomOrder()->first()->id,
            'published' => $this->faker->numberBetween(0, 1),
        ];
    }
}
