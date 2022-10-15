<?php

namespace App\Services\Blog;

use Exception;
use App\Services\BlogInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Blog\TagModel;
use App\Models\Models\Blog\BlogModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\Models\Blog\CategoryModel;
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
        DB::beginTransaction();
        try {
            $tagsAndCategories = collect($attribute)->only(['tags', 'categories'])->toArray();
            $blogAttribute = collect($attribute)->except(['tags', 'categories'])->toArray();
            $this->blogModel->unguard();
            $result = $this->blogModel->create(array_merge($blogAttribute, [
                'created_by' => 1,
                'created_at' => now()
            ]));
            $this->blogModel->reguard();
            DB::commit();
            return $result;
        } catch (Exception $th) {
            DB::rollBack();
            dd($th);
            throw $th;
        }
    }

    public function updateData($model, array $attributes): Model
    {
        return $this->blogModel;
    }

    public function getDependencies(): array
    {
        return [
            'tags'       => TagModel::select(['id', 'name'])->where([])->orderBy('id')->limit(5)->get(),
            'categories' => CategoryModel::select(['id', 'name'])->where([])->orderBy('id')->limit(5)->get(),
        ];
    }
}
