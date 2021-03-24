<?php

use App\Http\Controllers\Blog\PostController;
use Illuminate\Support\Facades\Route;

Route::resource('blog', PostController::class)
    ->only('index','show')
    ->names('blog.posts');
