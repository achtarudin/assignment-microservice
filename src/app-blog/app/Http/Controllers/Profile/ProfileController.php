<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Services\Blog\BlogService;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(BlogService $blogService)
    {
        $query =  $blogService->findBy(['created_by' => auth()->user()->id])->with(['author'])
            ->withTrashed()
            ->orderBy('created_at', 'desc');
        $blogs = $query->paginate(10);
        $blogTotal = $query->count();
        return view('profile.profile-index', compact('blogs', 'blogTotal'));
    }
}
