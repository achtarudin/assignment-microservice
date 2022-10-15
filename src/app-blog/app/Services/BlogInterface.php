<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface BlogInterface
{
    public function findBy(array $filter = []) : Builder;
    public function storeData(array $attribute): Model;
    public function updateData(Model $model, array $attributes): Model;
    public function getDependencies(): array;
}
