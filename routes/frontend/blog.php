<?php

use App\Http\Controllers\Blog\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/blog',[PostController::class, 'index']);

Route::get('posts/search',[PostController::class,'search'])->name('posts.search');
