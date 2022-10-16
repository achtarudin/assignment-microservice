@extends('layouts.app', ['title' => 'Login | Blog'])

@php
    $actionUrl = Route::is('post.login');
    $btnName =  'Login';
@endphp
@section('contents')
    <div class="d-flex justify-content-center" style="width: 100%">

        <div style="width: 65%">
            @includeWhen(!$errors->isEmpty() , 'components.alert-error')
            @includeWhen(session()->has('success') , 'components.alert-success')

              <div class="card p-2 shadow-sm border-0 my-2">
                <form action="{{ $actionUrl }}" method="post" autocomplete="off">
                    @csrf
                    @includeWhen(true, 'components.input', [
                        'label'         => 'Email',
                        'id'            => 'email',
                        'name'          => 'email',
                        'type'          => 'email',
                        'placeholder'   => 'Your Email',
                        'value'         => old('email')
                            ? old('email')
                            : 'user1@email.com'
                    ])

                    @includeWhen(true, 'components.input', [
                        'label'         => 'Password',
                        'id'            => 'password',
                        'name'          => 'password',
                        'placeholder'   => 'Password',
                        'type'          => 'password',
                        'value'         => old('password')
                            ? old('password')
                            : 'secret214'
                    ])

                    <div class="d-flex justify-content-between mt-2">
                        <div class="align-self-center">
                            <a href="{{route('registration')}}" class="text-info">Registration</a>
                            |
                            <a href="{{route('blogs.index')}}" class="text-info">blogs</a>
                        </div>
                        <button type="submit" class="btn btn-lg btn-info">{{$btnName}}</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection
