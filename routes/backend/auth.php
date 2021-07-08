<?php

Route::group([
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog',
    'middleware' => ['auth']
], function () {
    /**
     * Просмотр и редактирование пользователей
     **/
    Route::resource('users', 'UserController')
        ->except('create', 'store', 'destroy')
        ->names('blog.admin.users');

});
