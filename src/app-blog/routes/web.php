<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'available_homes' => ['/blogs']
    ]);
});

Route::middleware('microservice')->group(function () {

    Route::namespace('App\Http\Controllers')->group(function () {

        Route::resource('blogs', 'Blog\BlogController');

        Route::middleware('microservice.auth')->group(function () {
            Route::get('profile', 'Profile\ProfileController@index')->name('profile.index');
            Route::resource('categories', 'Blog\CategoryController');
            Route::resource('tags', 'Blog\TagController');
        });
    });

    Route::namespace('App\Http\Controllers\Auth')->group(function () {
        Route::middleware('microservice.guest')->group(function () {
            Route::get('login', 'BlogAuthController@login')->name('login');
            Route::post('login', 'BlogAuthController@postLogin')->name('post.login');
            Route::get('registration', 'BlogAuthController@registration')->name('registration');
            Route::post('registration', 'BlogAuthController@postRegistration')->name('post.postRegistration');
        });

        Route::middleware('microservice.auth')->group(function () {
            Route::get('logout', 'BlogAuthController@logout')->name('logout');
        });
    });
});
