<?php

use Illuminate\Support\Facades\Route;

Route::get('/blog/search', '\App\Http\Controllers\Blog\PostController@search')
    ->name('blog.posts.search');

Route::resource('blog', \App\Http\Controllers\Blog\PostController::class)
    ->only('index','show')
    ->names('blog.posts');
