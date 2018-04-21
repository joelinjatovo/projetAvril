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

// Registration 
Route::get('register/{role}', 'Auth\RegisterController@index')->name('register')->middleware('guest');
Route::post('register/{role}', 'Auth\RegisterController@register')->name('register')->middleware('guest');

// Static pages
Route::get('/', 'IndexController@index')->name('home');
Route::get('localization/{locale}', 'LocalizationController@index')->name('localization');
Route::get('search', 'SearchController@index')->name('search');
Route::get('services', 'IndexController@services')->name('services');
Route::get('terms', 'IndexController@terms')->name('terms');
Route::get('help', 'IndexController@help')->name('help');
Route::get('publicities', 'IndexController@publicities')->name('publicities');
Route::get('confidentialities', 'IndexController@confidentialities')->name('confidentialities');

// List product by Category OR no
Route::get('shop/{category?}', 'ShopController@index')->name('shop.index');
// Add product in cart
Route::get('shop/add/{product}', 'ShopController@add')->name('shop.add');
// Show cart
Route::get('shop/cart', 'ShopController@cart')->name('shop.cart');
// View Product
Route::get('product/{product}', 'ProductController@index')->name('product.index');

Route::get('blogs/{filter?}', 'BlogController@all')->name('blog.all');
Route::get('blog/{blog}', 'BlogController@index')->name('blog.index');
Route::get('blog/{blog}/comments', 'CommentController@index')->name('comment.list');

Route::middleware(["auth"])->group(function () {
    Route::get('profile', 'UserController@profile')->name('profile');
    
    // Save OR Star Product
    Route::post('product/{product}/{type}', 'LabelController@storeOrUpdate')->name('label.store');
    // List saved products OR starred Product
    Route::post('products/{type}', 'LabelController@all')->name('label.list');
    
    Route::post('blog/{blog}/comment', 'CommentController@store')->name('comment.store');
    Route::get('blog/{blog}/comment/{comment}', 'CommentController@edit')->name('comment.edit');
    Route::post('blog/{blog}/comment/{comment}', 'CommentController@update')->name('comment.update');
    
    // Send a message by Javascript.
    Route::get('/chat', 'ChatController@index');
    Route::get('/chat/messages', 'ChatController@fetchMessages');
    Route::post('/chat/messages', 'ChatController@sendMessage');
    
});

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
    
    // Product Controller Groups
    Route::get('products/{filter?}', 'ProductController@all')->name('admin.product.list');
    Route::prefix('product')->group(function(){
        Route::get('/', 'ProductController@create')->name('admin.product.create');
        Route::post('/', 'ProductController@store')->name('admin.product.store');
        Route::get('update/{product}', 'ProductController@edit')->name('admin.product.edit');
        Route::post('update/{product}', 'ProductController@update')->name('admin.product.update');
        Route::get('delete/{product}', 'ProductController@delete')->name('admin.product.delete');
        Route::get('archive/{product}', 'ProductController@archive')->name('admin.product.archive');
        Route::get('restore/{product}', 'ProductController@restore')->name('admin.product.restore');
        Route::get('star/{product}', 'ProductController@star')->name('admin.product.star');
    });
    
    // Category Controller Groups
    Route::get('categories/{filter?}', 'CategoryController@allAdmin')->name('admin.category.list');
    Route::prefix('category')->group(function(){
        Route::get('/', 'CategoryController@create')->name('admin.category.create');
        Route::post('/', 'CategoryController@store')->name('admin.category.store');
        Route::get('update/{category}', 'CategoryController@edit')->name('admin.category.edit');
        Route::post('update/{category}', 'CategoryController@update')->name('admin.category.update');
        Route::get('active/{category}', 'CategoryController@active')->name('admin.category.active');
        Route::get('block/{category}', 'CategoryController@block')->name('admin.category.block');
        Route::get('disable/{category}', 'CategoryController@disable')->name('admin.category.disable');
        Route::get('delete/{category}', 'CategoryController@delete')->name('admin.category.delete');
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
    
    // Pub Controller Groups
    Route::get('pubs/{filter?}', 'PubController@allAdmin')->name('admin.pub.list');
    Route::prefix('pub')->group(function(){
        Route::get('/', 'PubController@create')->name('admin.pub.create');
        Route::post('/', 'PubController@store')->name('admin.pub.store');
        Route::get('update/{pub}', 'PubController@edit')->name('admin.pub.edit');
        Route::post('update/{pub}', 'PubController@update')->name('admin.pub.update');
        Route::get('delete/{pub}', 'PubController@delete')->name('admin.pub.delete');
        Route::get('restore/{pub}', 'PubController@restore')->name('admin.pub.restore');
    });
    
    // Config Controller
    Route::prefix('config')->group(function () {
        Route::get('site', 'ConfigController@site')->name('config.site');
        Route::post('site', 'ConfigController@site')->name('config.site.update');
        Route::get('social', 'ConfigController@social')->name('config.social');
        Route::post('social', 'ConfigController@social')->name('config.social.update');
        Route::get('fontawesome', 'ConfigController@fontawesome')->name('config.fontawesome');
    });
    
});
