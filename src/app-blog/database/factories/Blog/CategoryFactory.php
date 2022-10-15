<?php

namespace Database\Factories\Blog;

use App\Models\Models\Blog\CategoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    protected $model = CategoryModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'         => fake()->unique()->sentence(2),
            'created_at'   => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
