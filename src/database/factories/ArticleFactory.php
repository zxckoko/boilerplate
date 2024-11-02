<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucwords(implode(' ', fake()->words(rand(16, 64)))), // number of words
            'head' => fake()->sentence(),
            'body' => fake()->paragraph(rand(16, 64)), // number of sentences
            'created_at' => now()->subDays(28),
            'updated_at' => now()->subMinutes(rand(1, 1*60*24*28)),
        ];
    }
}
