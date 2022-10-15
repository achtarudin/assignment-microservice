<?php

namespace App\Http\Requests\Blog;

use Illuminate\Validation\Rule;
use App\Services\Blog\BlogService;
use Illuminate\Foundation\Http\FormRequest;

class BlogCreateRequest extends FormRequest
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tagIds = $this->blogService->getDependencies()['tags']->pluck('id')->toArray();
        $categoryIds = $this->blogService->getDependencies()['categories']->pluck('id')->toArray();
        return [
            'title'         => 'required|min:2|max:255',
            'content'      => 'required|min:20',
            'tags'          => 'nullable|array',
            'categories'    => 'nullable|array',
            'tags.*'        => [
                'required', 'integer', 'exists:blog_tags,id',
                Rule::in($tagIds)
            ],
            'categories.*'        => [
                'required', 'integer', 'exists:blog_categories,id',
                Rule::in($categoryIds)
            ],
        ];
    }
}
