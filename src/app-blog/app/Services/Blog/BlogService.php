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

    public function storeData(array $attributes): Model
    {
        DB::beginTransaction();
        try {
            $userId = 1;

            // filter the attributes for blog
            $blogAttribute = collect($attributes)->except(['tags', 'categories'])->toArray();

            $this->blogModel->unguard();

            // save blog content
            $result = $this->blogModel->create(array_merge($blogAttribute, [
                'created_by' => $userId,
                'created_at' => now()
            ]));

            $this->blogModel->reguard();

            // filter the attributes for tags and categories
            $tagsAndCategories = collect($attributes)->only(['tags', 'categories']);

            $tagMap = collect($tagsAndCategories['tags'] ?? [])->map(function ($item, $key) {
                return [
                    'detailable_id' => $item,
                    'detailable_type' => TagModel::class
                ];
            });

            $categoryMap = collect($tagsAndCategories['categories'] ?? [])->map(function ($item, $key) {
                return [
                    'detailable_id' => $item,
                    'detailable_type' => CategoryModel::class
                ];
            });

            $mergeMap = $tagMap->merge($categoryMap);

            // save tag details
            $result->content_details()->createMany(
                $mergeMap->toArray()
            );

            DB::commit();
            return $result;
        } catch (Exception $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function updateData($model, array $attributes): Model
    {
        DB::beginTransaction();
        try {
            $userId = 1;
            $blogAttribute = collect($attributes)->except(['tags', 'categories'])->toArray();

            $this->blogModel = $model;

            $this->blogModel->unguard();

            $this->blogModel->update(array_merge($blogAttribute, [
                'updated_at' => now()
            ]));

            $this->blogModel->reguard();

            // filter the attributes for tags and categories
            $tagsAndCategories = collect($attributes)->only(['tags', 'categories']);

            $tagMap = collect($tagsAndCategories['tags'] ?? [])->map(function ($item, $key) {
                return [
                    'detailable_id' => $item,
                    'detailable_type' => TagModel::class
                ];
            });

            $categoryMap = collect($tagsAndCategories['categories'] ?? [])->map(function ($item, $key) {
                return [
                    'detailable_id' => $item,
                    'detailable_type' => CategoryModel::class
                ];
            });

            $mergeMap = $tagMap->merge($categoryMap);
            $this->blogModel->content_details()->update(['status' => false]);

            $mergeMap->each(function ($detailable, $key) {
                $this->blogModel->content_details()->updateOrCreate(
                    array_merge($detailable, [
                        'content_id' => $this->blogModel->id,
                        'status'     => false,
                    ]),
                    array_merge($detailable, [
                        'status'     => true,
                    ]),
                );
            });

            $this->blogModel->content_details()->where(['status' => false])->delete();


            DB::commit();
            return $this->blogModel;
        } catch (Exception $th) {
            DB::rollBack();
            throw $th;
        }
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
