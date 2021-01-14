<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
Route::group(['prefix' => 'digging_deeper'], function () {
	Route::get('collection', [App\Http\Controllers\DiggingDeeperController::class, 'collection'])
		->name('digging_deeper.collection');
	Route::get('process-video', [App\Http\Controllers\DiggingDeeperController::class, 'processVideo'])
		->name('digging_deeper.process-video');
	Route::get('prepare-catalog', [App\Http\Controllers\DiggingDeeperController::class, 'prepareCatalog'])
		->name('digging_deeper.prepare-catalog');
});
