<?php

namespace App\Services\Blog;

use App\Services\BlogInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ExampleService implements BlogInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findBy(array $filter = []): Builder
    {
        return $this->model->where($filter);
    }


    public function storeData(array $attribute): Model
    {
        return $this->model;
    }

    public function updateData($model, array $attributes): Model
    {
        return $this->model;
    }

    public function getDependencies(): array
    {
        return [];
    }
}
