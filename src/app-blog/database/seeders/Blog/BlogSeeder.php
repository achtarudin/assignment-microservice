<?php

namespace Database\Seeders\Blog;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Models\Blog\BlogModel;
use App\Models\Models\Blog\CategoryModel;
use App\Models\Models\Blog\TagModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TagModel::factory()
            ->count(5)
            ->create();

        CategoryModel::factory()
            ->count(5)
            ->create();

        BlogModel::factory()
            ->count(5)
            ->sequence(function () {
                return [
                    'created_by' => User::inRandomOrder()->first()->id,
                ];
            })
            ->create();
    }
}
