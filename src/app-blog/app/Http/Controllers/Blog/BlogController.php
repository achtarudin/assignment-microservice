<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Services\Blog\BlogService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogCreateRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
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
        dd(request()->all(), $valid);
    }

    public function show($id)
    {
        $result =  $this->blogService->findBy(['id' => $id])->first();

        throw_if(!$result, new HttpException(404, 'Blog not found'));

        return view('blog.blog-show', compact('result'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
