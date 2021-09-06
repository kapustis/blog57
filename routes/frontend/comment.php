<?php

use Illuminate\Support\Facades\Route;

Route::post('/blog/{post}/comments','\App\Http\Controllers\Blog\CommentController@store');
Route::get('/blog/{post}/comments','\App\Http\Controllers\Blog\CommentController@index');

Route::patch('/comments/{comment}','\App\Http\Controllers\Blog\CommentController@update');
Route::delete('/comments/{comment}','\App\Http\Controllers\Blog\CommentController@destroy');
