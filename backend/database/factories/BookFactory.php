<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'thumb' => fake()->imageUrl(),
            'title' => fake()->title(),
            'author' => fake()->name(),
            'isbn' => fake()->isbn13(),
            'description' => fake()->text(),
            'number_pages' => rand(50, 500),            
            'publisher' => fake()->name(),
            'user_id' => User::inRandomOrder()->first(),
            'category_id' => Category::inRandomOrder()->first(),
            //'publisher_id' => Publisher::inRandomOrder()->first(),
        ];
    }
}
