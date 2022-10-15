<?php

namespace App\Services\Blog;

use App\Services\BlogInterface;
use App\Models\Models\Blog\BlogModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class BlogService implements BlogInterface
{

    protected $blogModel;

    public function __construct(BlogModel $blogModel)
    {
        $this->blogModel = $blogModel;
    }

    public function findBy(array $filter = []): Builder
    {
        return $this->blogModel->where($filter);
    }

    public function storeData(array $attribute): Model
    {
        return $this->blogModel;
    }

    public function updateData($model, array $attributes): Model
    {
        return $this->blogModel;
    }

    public function getDependencies(): array
    {
        return [];
    }
}
