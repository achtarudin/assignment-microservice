@extends('layouts.app', ['title' => isset($result->title) ? "{$result->title} | Blog" : null])
@section('contents')
    <div>
        {{-- Title --}}
        <div>
            <div class="d-flex justify-content-start mb-2">
                <div class="me-3">
                    <a href="{{ route('blogs.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
                <div class="align-self-center text-center flex-grow-1">
                    <h2>{{ $result->title }}</h2>
                </div>
                 <div class="me-3">
                    <a href="{{ route('blogs.edit', $result->id) }}" class="btn btn-info btn-sm">Edit</a>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="card border-0 shadow-sm p-3">
            <p>{{ $result->content }}</p>

            <div class="d-flex justify-content-between">
                <div class="align-self-start">
                    <div>
                        Tags: {{ $result->tag_details->pluck('tag')->pluck('name')->implode(', ') }}
                    </div>

                    <div>
                        Category: {{ $result->tag_details->pluck('category')->pluck('name')->implode(', ') }}
                    </div>
                </div>
                <div>
                    <div class="text-success">
                        Author : {{$result->author->name}}
                    </div>
                    @if ($result->created_at_for_human)
                        <div class="text-info">
                            Created : {{$result->created_at_for_human}}
                        </div>
                    @endif

                    @if ($result->updated_at_for_human)
                        <div>
                            Updated : {{$result->updated_at_for_human}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
