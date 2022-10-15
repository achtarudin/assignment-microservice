<?php

namespace Database\Factories\Blog;

use App\Models\Models\Blog\BlogModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogFactory extends Factory
{
    protected $model = BlogModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'         => fake()->unique()->sentence(2),
            'content'       => fake()->text(),
            'created_at'    => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
