<?php

use Illuminate\Support\Facades\Route;

Route::post('/blog/{post}/comments','\App\Http\Controllers\Blog\CommentController@store');
Route::get('/blog/{post}/comments','\App\Http\Controllers\Blog\CommentController@index');
