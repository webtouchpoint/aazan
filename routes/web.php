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

// Admin area
Route::get('admin', function () {
    return redirect('/admin/ebooks');
});


Route::get('posts/tags/{tag}', 'TagsController@getPostsByTagName');
Route::get('blog', 'BlogController@index')->name('blog.index');
Route::get('blog/{slug}', 'BlogController@showPost')->name('blog.show');;


Route::prefix('admin')->group(function() {
	Route::delete('ebooks/{ebook}/deletefile', 'EbooksController@deleteFile')->name('ebooks.deletefile');
	Route::resource('ebooks', 'EbooksController');
	Route::resource('tags', 'TagsController');
	Route::delete('posts/{post}/deleteimage', 'PostsController@deleteImage')->name('posts.deleteimage');
	Route::resource('posts', 'PostsController');
});


Route::get('/', function () {
	flash('Welcome Aboard!');
    return view('welcome');
});

Auth::routes();

Route::get('/ebooks', 'PagesController@showEBooks')->name('pages.ebooks');
Route::get('/home', 'HomeController@index')->name('home');
