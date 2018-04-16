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
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Illuminate\Support\Facades\Storage;

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('storage/{album}/{filename}', function ($album,$filename)
{
    $path = storage_path('app/'.$album.'/'.$filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

Route::get('storage/thumbnail/{album}/{filename}', function ($album,$filename)
{
    $path = storage_path('app/'.$album.'/'.$filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $thumbnail = storage_path('app/'.$album.'/thumb_'.$filename);
    if (!File::exists($thumbnail)) {
        InterventionImage::make($path)->resize(320,240)->save($thumbnail);
    }
    $file = File::get($thumbnail);
    $type = File::mimeType($thumbnail);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

// Not authentified routes
Route::get('register/{role}', 'Auth\RegisterController@index')->name('register')->middleware('guest');

// Public routes
Route::get('/', 'IndexController@index')->name('home');
Route::get('localization/{locale}', 'LocalizationController@index')->name('localization');
Route::get('search', 'SearchController@index')->name('search');
Route::get('services', 'IndexController@services')->name('services');
Route::get('terms', 'IndexController@terms')->name('terms');
Route::get('help', 'IndexController@help')->name('help');
Route::get('publicities', 'IndexController@publicities')->name('publicities');
Route::get('confidentialities', 'IndexController@confidentialities')->name('confidentialities');
Route::get('products', 'ProductController@all')->name('product.all');

Route::get('blogs/{filter?}', 'BlogController@all')->name('blog.all');
Route::get('blog/{blog}', 'BlogController@index')->name('blog.index');

Route::get('pages/{filter?}', 'PageController@all')->name('page.all');
Route::get('page/{blog}', 'PageController@index')->name('page.index');

Route::prefix('admin')->middleware(["auth","role:admin"])->group(function () {
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
    
    Route::get('card', 'AdminController@card')->name('admin.card');
    
    // Blog Controller Groups
    Route::get('blogs/{filter?}', 'BlogController@allAdmin')->name('admin.blog.list');
    Route::prefix('blog')->group(function(){
        Route::get('/', 'BlogController@create')->name('admin.blog.create');
        Route::post('/', 'BlogController@store')->name('admin.blog.store');
        Route::get('update/{blog}', 'BlogController@edit')->name('admin.blog.edit');
        Route::post('update/{blog}', 'BlogController@update')->name('admin.blog.update');
        Route::get('delete/{blog}', 'BlogController@delete')->name('admin.blog.delete');
        Route::get('archive/{blog}', 'BlogController@archive')->name('admin.blog.archive');
        Route::get('restore/{blog}', 'BlogController@restore')->name('admin.blog.restore');
        Route::get('star/{blog}', 'BlogController@star')->name('admin.blog.star');
    });
    
    // Page Controller Groups
    Route::get('pages/{filter?}', 'PageController@allAdmin')->name('admin.page.list');
    Route::prefix('page')->group(function(){
        Route::get('/', 'PageController@create')->name('admin.page.create');
        Route::post('/', 'PageController@store')->name('admin.page.store');
        Route::get('update/{blog}', 'PageController@edit')->name('admin.page.edit');
        Route::post('update/{blog}', 'PageController@update')->name('admin.page.update');
        Route::get('delete/{blog}', 'PageController@delete')->name('admin.page.delete');
        Route::get('archive/{blog}', 'PageController@archive')->name('admin.page.archive');
        Route::get('restore/{blog}', 'PageController@restore')->name('admin.page.restore');
        Route::get('star/{blog}', 'PageController@star')->name('admin.page.star');
    });
    
    // User Controller Groups
    Route::get('users/{filter?}', 'UserController@all')->name('admin.user.list');
    Route::prefix('user')->group(function(){
        Route::get('/', 'UserController@create')->name('admin.user.create');
        Route::post('/', 'UserController@store')->name('admin.user.store');
        Route::get('update/{user}', 'UserController@edit')->name('admin.user.edit');
        Route::post('update/{user}', 'UserController@update')->name('admin.user.update');
        Route::get('active/{user}', 'UserController@active')->name('admin.user.active');
        Route::get('block/{user}', 'UserController@block')->name('admin.user.block');
        Route::get('disable/{user}', 'UserController@disable')->name('admin.user.disable');
        Route::get('delete/{user}', 'UserController@delete')->name('admin.user.delete');
    });
    
    // Config Controller
    Route::prefix('config')->group(function () {
        Route::get('site', 'ConfigController@site')->name('config.site');
        Route::post('site', 'ConfigController@site')->name('config.site.update');
        Route::get('site', 'ConfigController@social')->name('config.social');
        Route::post('site', 'ConfigController@social')->name('config.social.update');
        Route::get('fontawesome', 'ConfigController@fontawesome')->name('config.fontawesome');
    });
});

Route::get('profile', 'UserController@profile')->name('profile')->middleware('auth');


Route::get('/admin/pub/{title}', 'PubController@index')->name('pub.index');
Route::get('/admin/pubs', 'PubController@all')->name('pub.all');

Route::get('/admin/pages', 'PageController@all')->name('page.all');

// Send a message by Javascript.
Route::get('/chat', 'ChatController@index');
Route::get('/chat/messages', 'ChatController@fetchMessages');
Route::post('/chat/messages', 'ChatController@sendMessage');
