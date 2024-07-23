<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'name' => $this->createUniqueCategoryName(),
            'description' => fake()->text()
        ];
    }

    public function createUniqueCategoryName(): string
    {
        $name = fake()->name();
        $category = Category::where('name', $name)->first();        
        if(!$category) return $name;
        return $this->createUniqueCategoryName();
    }
}
