@extends('layouts.app')
@section('contents')
    <div>
        <div>
            <div class="d-flex justify-content-start mb-2">
                <div class="me-3">
                    <a href="{{ route('blogs.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
                <div class="align-self-center text-center flex-grow-1">
                    <h2>{{ $result->title }}</h2>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-3">
            <p>{{ $result->content }}</p>

            <div class="d-flex justify-content-between">
                <div class="align-self-start">
                    <div>
                        Tags: {{collect(['tag1', 'tag2', 'tag3'])->implode(', ')}}
                    </div>

                    <div>
                        Category: {{collect(['Category1', 'Category2'])->implode(', ')}}
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
