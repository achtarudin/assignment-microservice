<?php

namespace Database\Factories\Blog;

use App\Models\Models\Blog\TagModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TagFactory extends Factory
{
    protected $model = TagModel::class;

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
