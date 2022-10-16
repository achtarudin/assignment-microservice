@extends('layouts.app', ['title' => auth()->user()->name])

@section('contents')
    <div class="d-flex justify-content-between">
        <div class="align-self-center flex-grow-1">
            <h1>Blog Profile</h1>
        </div>
        <div class="align-self-center">
            @auth
                <a href="{{ route('blogs.index') }}" class="btn btn-success btn-sm">Blogs</a>
                <a href="{{ route('blogs.create') }}" class="btn btn-info btn-sm">New Blog</a>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-success btn-sm">Login</a>
            @endauth

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm ">
                <div class="p-2">
                    <div>Name: {{ auth()->user()->name }}</div>
                    <div>Email: {{ auth()->user()->email }}</div>
                    <div>Total Blog: {{ $blogTotal }}</div>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            @foreach ($blogs as $blog)
                <div class="card shadow-sm border-0 px-2 pt-2 mb-2">
                    <div class="card-title">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('blogs.show', $blog->id) }}" class="text-info">{{ $blog->title }}</a>
                                <div>Created: {{ $blog->created_at_for_human }}</div>
                                <div>Updated: {{ $blog->updated_at_for_human }}</div>
                            </div>
                            <div class="align-self-center">Status: {{ $blog->trashed() ? 'Deleted' : 'Published' }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
