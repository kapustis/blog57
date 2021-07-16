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

    // доп.маршрут, чтобы назначить роль
    Route::get('user/{user}/role/{role}/assign', 'UserRoleController@assignRole')
        ->name('user.assign.role');
    // доп.маршрут, чтобы отнять роль
    Route::get('user/{user}/role/{role}/unassign', 'UserRoleController@unassignRole')
        ->name('user.unassign.role');
    // доп.маршрут, чтобы назначить право
    Route::get('user/{user}/perm/{permission}/assign', 'UserPermissionController@assignPermission')
        ->name('user.assign.perm');
    // доп.маршрут, чтобы отнять право
    Route::get('user/{user}/perm/{permission}/unassign', 'UserPermissionController@unassignPermission')
        ->name('user.unassign.perm');


});
