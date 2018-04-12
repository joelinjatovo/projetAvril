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
