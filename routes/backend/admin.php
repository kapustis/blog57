<?php

/** роуты админ части **/
Route::group(['namespace' => 'App\Http\Controllers\Blog\Admin', 'prefix' => 'admin/blog'], function () {
    $methods = ['index', 'create', 'store', 'edit', 'update'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');
    Route::resource('posts', 'PostController')
        ->except('show')
        ->names('blog.admin.posts');
});
/**  **/
