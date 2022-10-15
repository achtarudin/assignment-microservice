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
    return redirect()->route('blogs.index');
});

Route::namespace('App\Http\Controllers\Blog')->group(function () {
    Route::resource('blogs', 'BlogController');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
});
