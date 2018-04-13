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

Auth::routes();

// Not authentified routes
Route::get('register/{role}', 'Auth\RegisterController@index')->name('register');

// Guest routes
Route::get('/', 'IndexController@index')->name('home');
Route::get('localization/{locale}', 'LocalizationController@index')->name('localization');
Route::get('search', 'SearchController@index')->name('search');
Route::get('services', 'IndexController@services')->name('services');
Route::get('terms', 'IndexController@terms')->name('terms');
Route::get('help', 'IndexController@help')->name('help');
Route::get('publicities', 'IndexController@publicities')->name('publicities');
Route::get('confidentialities', 'IndexController@confidentialities')->name('confidentialities');

Route::get('products', 'ProductController@all')->name('product.all');
Route::get('blogs', 'BlogController@all')->name('blog.all');
Route::get('blog/{slug}', 'BlogController@index')->name('blog.index');

// Authentified routes
Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('admin/card', 'AdminController@card')->name('admin.card');

Route::get('admin/blogs/list', 'BlogController@listAdmin')->name('admin.blog.list');
Route::get('admin/blogs', 'BlogController@allAdmin')->name('admin.blog.all');
Route::get('admin/blog', 'BlogController@add')->name('blog.add');
Route::get('admin/blog/{id}', 'BlogController@edit')->name('blog.edit');
Route::post('admin/blog/{id}', 'BlogController@update')->name('blog.update');
Route::post('admin/blog/archive/{id}', 'BlogController@softDelete')->name('blog.delete.soft');
Route::post('admin/blog/restore/{id}', 'BlogController@restore')->name('blog.restore');
Route::post('admin/blog/delete/{id}', 'BlogController@delete')->name('blog.delete');

Route::get('admin/config/site', 'ConfigController@site')->name('config.site');
Route::post('admin/config/site', 'ConfigController@site')->name('config.site.update');
Route::get('admin/config/site', 'ConfigController@social')->name('config.social');
Route::post('admin/config/site', 'ConfigController@social')->name('config.social.update');
Route::get('admin/config/fontawesome', 'ConfigController@fontawesome')->name('config.fontawesome');

Route::get('admin/pub/{title}', 'PubController@index')->name('pub.index');
Route::get('admin/pubs', 'PubController@all')->name('pub.all');

Route::get('admin/pages', 'PageController@all')->name('page.all');
