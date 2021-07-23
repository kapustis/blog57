<?php

Route::group([
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog',
    'middleware' => ['auth']
], function () {
    /**
     * Viewing and editing users
     **/
    Route::resource('users', 'UserController')
        ->except('create', 'store', 'destroy')
        ->names('blog.admin.users');

    // additional route to assign role
    Route::get('user/{user}/role/{role}/assign', 'UserRoleController@assignRole')
        ->name('user.assign.role');
    // additional route to take away the role
    Route::get('user/{user}/role/{role}/unassign', 'UserRoleController@unassignRole')
        ->name('user.unassign.role');
    // additional route to assign permission
    Route::get('user/{user}/perm/{permission}/assign', 'UserPermissionController@assignPermission')
        ->name('user.assign.perm');
    // additional route to take away the permission
    Route::get('user/{user}/perm/{permission}/unassign', 'UserPermissionController@unassignPermission')
        ->name('user.unassign.perm');


});
