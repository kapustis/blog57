<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/home', 'HomeController@index')->name('home');
/** роуты админ части **/
Route::group(['namespace' => 'Blog\Admin', 'prefix' => 'admin/blog'], function () {
	$methods = ['index', 'create', 'store', 'edit', 'update'];
	Route::resource('categories', 'CategoryController')->only($methods)->names('blog.admin.categories');
	Route::resource('posts','PostController')
		->except('show')
		->names('blog.admin.posts');
});
/** роуты пользовательской части **/
Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
	Route::resource('posts', 'PostController')->names('blog.posts');
});
