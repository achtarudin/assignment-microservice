@extends('layouts.app')

@section('contents')
    <div>
        <div class="d-flex justify-content-between">
            <div class="align-self-center flex-grow-1">
                <h1>Blogs</h1>
            </div>
            <div class="align-self-center">
                @auth
                    <a href="{{ route('blogs.create') }}" class="btn btn-info btn-sm">New Blog</a>
                     <a href="{{ route('profile.index') }}" class="btn btn-success btn-sm">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success btn-sm">Login</a>
                @endauth

            </div>
        </div>

        @includeWhen(session()->has('success') , 'components.alert-success')

        <div class="mb-2">
            @foreach ($result->getCollection()->chunk(2) as $chunkBlog)
                <div class="row mb-2">
                    @foreach ($chunkBlog as $blogs)
                        <div class="col-md-6 mb-2">
                            <div class="card shadow-sm border-0 px-2 pt-2 ">
                                <div class="card-title">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <a href="{{ route('blogs.show', $blogs->id) }}"
                                                class="text-info">{{ $blogs->title }}</a>
                                            <div>By: {{ $blogs->author->name }}</div>
                                        </div>
                                        <div class="align-self-center">{{ $blogs->created_at_for_human }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end ">
            <div class="d-flex flex-column shadow-sm rounded p-2">
                {{ $result->links() }}
            </div>
        </div>
    </div>
@endsection
