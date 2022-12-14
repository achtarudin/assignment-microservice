<?php

namespace App\Http\Controllers\Blog;

use App\Services\Blog\BlogService;
use App\Http\Controllers\Controller;
use App\Models\Models\Blog\TagModel;
use App\Models\Models\Blog\CategoryModel;
use App\Http\Requests\Blog\BlogCreateRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
        $this->middleware('microservice.auth')->except(['index', 'show']);
    }

    public function index()
    {
        $result =  $this->blogService->findBy()->with(['author'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('blog.blog-index', compact('result'));
    }

    public function create()
    {
        $dependencies =  $this->blogService->getDependencies();
        return view('blog.blog', compact('dependencies'));
    }

    public function store(BlogCreateRequest $request)
    {
        $valid = $request->validated();
        $result = $this->blogService->storeData($valid);
        return redirect()->route('blogs.show', $result->id)->with('success', "Blog {$result->title} Created successfully ");
    }

    public function show($id)
    {
        $result =  $this->blogService->findBy(['id' => $id])->with([
            'category_details.category:id,name',
            'tag_details.tag:id,name',
            'category_details' => function ($query) {
                $query->where('detailable_type', CategoryModel::class);
            },
            'tag_details' => function ($query) {
                $query->where('detailable_type', TagModel::class);
            },
        ])->first();

        throw_if(!$result, new HttpException(404, 'Blog not found'));

        return view('blog.blog-show', compact('result'));
    }

    public function edit($id)
    {
        $dependencies =  $this->blogService->getDependencies();
        $result =  $this->blogService->findBy([
            'id' => $id,
            'created_by' => auth()->user()->id
        ])
            ->with([
                'tag_details.tag:id,name',
                'category_details.category:id,name',
                'category_details' => function ($query) {
                    $query->where('detailable_type', CategoryModel::class);
                },
                'tag_details' => function ($query) {
                    $query->where('detailable_type', TagModel::class);
                },
            ])
            ->first();

        throw_if(!$result, new HttpException(404, 'Blog not found'));

        return view('blog.blog', compact('dependencies', 'result'));
    }

    public function update(BlogCreateRequest $request, $id)
    {
        $valid = $request->validated();

        $result =  $this->blogService->findBy([
            'id' => $id,
            'created_by' => auth()->user()->id
        ])
            ->with(['category_details', 'tag_details'])
            ->first();

        throw_if(!$result, new HttpException(404, 'Blog not found'));

        $resultUpdate = $this->blogService->updateData($result, $valid);

        return redirect()->route('blogs.edit', $resultUpdate->id)->with('success', "Blog {$resultUpdate->title} update successfully ");
    }

    public function destroy($id)
    {
        $result =  $this->blogService->findBy([
            'id' => $id,
            'created_by' => auth()->user()->id
        ])
            ->with(['category_details', 'tag_details'])
            ->first();

        throw_if(!$result, new HttpException(404, 'Blog not found'));

        $result->delete();

        return redirect()->route('blogs.index')->with('success', "Blog {$result->title} deleted successfully ");

    }
}
