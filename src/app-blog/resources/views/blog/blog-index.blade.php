@extends('layouts.app')

@section('contents')
    <h1>Blog</h1>
    <ul>
        @foreach ($result as $blog)
            <li>
                <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
            </li>
        @endforeach
    </ul>
    <div class="d-flex justify-content-end">
        <div class="d-flex flex-column justify-item-end">
            {{ $result->links() }}
        </div>
    </div>
@endsection
