@extends('layouts.app', ['title' => 'Registration | Blog'])

@php
    $actionUrl = Route::is('post.registration');
    $btnName =  'Registration';
@endphp
@section('contents')
    <div class="d-flex justify-content-center" style="width: 100%">

        <div style="width: 65%">
            @includeWhen(!$errors->isEmpty() , 'components.alert-error')

              <div class="card p-2 shadow-sm border-0 my-2">
                <form action="{{ $actionUrl }}" method="post" autocomplete="off">
                    @csrf
                    @includeWhen(true, 'components.input', [
                        'label'         => 'Name',
                        'id'            => 'name',
                        'name'          => 'name',
                        'placeholder'   => 'Your Name',
                        'value'         => old('name')
                            ? old('name')
                            : 'JOSY sds'
                    ])
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

                    @includeWhen(true, 'components.input', [
                        'label'         => 'Password Confirmation',
                        'id'            => 'password_confirmation',
                        'name'          => 'password_confirmation',
                        'placeholder'   => 'Password Confirmation',
                        'type'          => 'password',
                        'value'         => old('password_confirmation')
                            ? old('password_confirmation')
                            : 'secret214'
                    ])

                    <div class="d-flex justify-content-between mt-2">
                         <div class="align-self-center">
                            <a href="{{route('login')}}" class="text-info">Login</a>
                        </div>
                        <button type="submit" class="btn btn-lg btn-info">{{$btnName}}</button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection
