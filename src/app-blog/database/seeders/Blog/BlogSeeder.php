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
            ->count(10)
            ->create();

        CategoryModel::factory()
            ->count(10)
            ->create();

        BlogModel::factory()
            ->count(50)
            ->sequence(function () {
                return [
                    'created_by' => User::inRandomOrder()->first()->id,
                ];
            })
            ->create();
    }
}
