@extends('layouts.app')
@php
    $title = Route::is('blogs.create') ? 'Create a new blog' : 'Edit a blog';
    $actionUrl = Route::is('blogs.create') ? route('blogs.store') : route('blogs.update', $result->id);

    $valueTitle = old('title') ? old('title') : (isset($result->title) && $errors->isEmpty()? $result->title : '');
    $valueContent = old('content') ? old('content') : (isset($result->content) && $errors->isEmpty() ? $result->content : '');
    $btnName = Route::is('blogs.create') ? 'Create' : 'Update';
@endphp
@section('contents')
    <div class="p-2">
        <div class="d-flex justify-content-start mb-2">
            <div class="me-3">
                <a href="{{ route('blogs.index') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <div class="align-self-center text-center flex-grow-1">
                <h2>{{ $title }}</h2>
            </div>
        </div>

        @includeWhen(!$errors->isEmpty(), 'components.alert-error')

        <form action="{{ $actionUrl }}" method="post">
            @isset($result)
                @method('PUT')
            @endisset
            @csrf
            <div class="d-flex justify-content-end mb-4">
                <button type="submit" class="btn btn-lg btn-info">{{$btnName}}</button>
            </div>
            <div class="row">
                <div class="col-md-8">
                    @includeWhen(true, 'components.input', [
                        'label'         => 'Title',
                        'id'            => 'title',
                        'name'          => 'title',
                        'placeholder'   => 'Title',
                        'value'         => old('title')
                            ? old('title')
                            : (isset($result->title) && $errors->isEmpty() ? $result->title : '')
                    ])

                    <div class="mb-2">
                        <label for="content" class="form-label text-info">Contents</label>
                        <textarea class="form-control" rows="10" id="content"  name="content">{{ $valueContent }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <label class="form-label text-info">Tags</label>
                            @foreach ($dependencies['tags']->chunk(2) as $tagChunk)
                                <div class="row">
                                    @foreach ($tagChunk as $keyTag => $tag)
                                        <div class="col-md-6">
                                            @include('components.checkbox', [
                                                'id'        => "tag-{$keyTag}",
                                                'value'     => $tag->id,
                                                'name'      => "tags[{$keyTag}]",
                                                'label'     => $tag->name . old("tags.{$keyTag}"),
                                                'isCheck'   => old("tags.{$keyTag}") && old("tags.{$keyTag}") == $tag->id
                                                    ? true
                                                    : (isset($result) && $result->tag_details->contains('detailable_id', $tag->id) && $errors->isEmpty() ? true : false)
                                            ])
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <label class="form-label text-info">Categories</label>
                            @foreach ($dependencies['categories']->chunk(2) as $categoryChunk)
                                <div class="row">
                                    @foreach ($categoryChunk as $keyCategory => $category)
                                        <div class="col-md-6">

                                            @include('components.checkbox', [
                                                'id'        => "category-{$keyCategory}",
                                                'value'     => $category->id,
                                                'name'      => "categories[{$keyCategory}]",
                                                'label'     => $category->name . old("categories.{$keyCategory}"),
                                                'isCheck'   => old("categories.{$keyCategory}") && old("categories.{$keyCategory}") == $category->id
                                                    ? true
                                                    : (isset($result) && $result->category_details->contains('detailable_id', $category->id) ? true : false)
                                            ])
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
