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

Route::get('mail/basic','MailController@basic_email');
Route::get('mail/html','MailController@html_email');
Route::get('mail/attachment','MailController@attachment_email');


Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

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

// Localisation
Route::get('localization/{locale}', 'LocalizationController@index')->name('localization');

// Search
Route::get('search', 'SearchController@index')->name('search');

// Static pages
Route::get('/', 'IndexController@index')->name('home');
Route::get('services', 'IndexController@services')->name('services');
Route::get('terms', 'IndexController@terms')->name('terms');
Route::get('help', 'IndexController@help')->name('help');
Route::get('publicities', 'IndexController@publicities')->name('publicities');
Route::get('confidentialities', 'IndexController@confidentialities')->name('confidentialities');
Route::get('apls', 'IndexController@apl')->name('apls');

// Blog
Route::get('blogs/{filter?}', 'BlogController@all')->name('blog.all');
Route::get('blog/{blog}', 'BlogController@index')->name('blog.index');

// Action
Route::get('comments/{blog}', 'CommentController@index');
Route::post('comments', 'CommentController@store');
Route::post('comments/{comment}/{action}', 'CommentController@update');

// Shop and Product
Route::get('shop/{category?}', 'ShopController@index')->name('shop.index');// List product by Category OR no
Route::get('product/{product}', 'ProductController@index')->name('product.index');// View Product

// Baintree
Route::post('braintree/webhook', 'WebhookController@handleWebhook');
Route::get('braintree/token', 'BraintreeController@token')->name('braintree.token');

// Chart
Route::get('api/chart/categories', 'ChartController@categories')->name('chart.categories');
Route::get('api/chart/locations/{type?}', 'ChartController@locations')->name('chart.locations');
Route::get('api/chart/prices', 'ChartController@prices')->name('chart.prices');
Route::get('api/chart/sellers', 'ChartController@sellers')->name('chart.sellers');
Route::get('api/chart/dates/{role?}', 'ChartController@dates')->name('chart.dates');
Route::get('api/chart/carts', 'ChartController@carts')->name('chart.carts');

Route::middleware('guest')->group(function(){
    Route::get('register/{role}', 'Auth\RegisterController@index')->name('register');
    Route::post('register/{role}', 'Auth\RegisterController@register');
    Route::get('verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
    Route::get('resend-code/{user}', 'Auth\RegisterController@resendActivation')->name('resend_code');
});

// Mail
Route::get('contact','MailController@index')->name('contact');
Route::post('contact','MailController@index')->name('contact');

Route::middleware(["auth"])->group(function(){
    // Mail
    Route::get('contact/{user}','MailController@contact')->name('contact.user');
    Route::post('contact/{user}','MailController@sendMail');

    // Notification
    Route::get('notifications/{filter?}', 'NotificationController@all')->name('notification.list');

    // Mail Controller Groups
    Route::get('mails/{filter?}', 'MailController@all')->name('mail.list');
    Route::prefix('mail')->group(function(){
        Route::get('{mail}', 'MailController@view')->name('mail.index');
        Route::get('delete/{mail}', 'MailController@delete')->name('mail.delete');
    });

    //Chat
    Route::get('chat', 'ChatController@index');
    Route::post('chat/threads', 'ThreadController@store');
    Route::post('chat/messages', 'ChatController@store');

    // Label
    Route::get('product/{product}/{type}', 'LabelController@storeOrUpdate')->name('label.store');// Save OR Star Product
    Route::get('products/{type}', 'LabelController@all')->name('label.list');// List saved products OR starred Product

    // Braintree
    Route::get('/plans', 'PlanController@index');
    Route::get('/plan/{plan}', 'PlanController@show');
    Route::post('/subscribe', 'PlanController@subscribe');
    
    // Profile
    Route::prefix('profile')->group(function(){
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('edit', 'ProfileController@profile')->name('profile.edit');
        Route::post('edit', 'ProfileController@editProfile');
        Route::get('password', 'ProfileController@password')->name('password.edit');
        Route::post('password', 'ProfileController@updatePassword');
        Route::get('avatar', 'ProfileController@avatar')->name('avatar.edit');
        Route::post('avatar', 'ProfileController@updateAvatar');
        Route::get('location', 'ProfileController@location')->name('location.edit');
        Route::post('location', 'ProfileController@updateLocation');
    });
    

});


Route::middleware(["auth", "role:member"])->group(function(){
    
    Route::get('select-apl/{product}', 'ShopController@selectApl')->name('shop.select.apl');
    Route::post('product/{product}', 'ShopController@add')->name('shop.add');
    
    Route::get('cart', 'ShopController@cart')->name('shop.cart');// Show cart
    Route::get('shop/reduce/{product}', 'ShopController@reduceByOne')->name('shop.product.reduce');
    
    Route::get('shop/delete/{product}', 'ShopController@deleteAll')->name('shop.product.delete');
    Route::get('checkout', 'ShopController@getCheckout')->name('shop.product.checkout');
    Route::post('checkout', 'ShopController@postCheckout')->name('shop.product.postCheckout');
    
    Route::prefix('member')->group(function(){

        Route::get('select-apl', 'MemberController@selectApl')->name('member.select.apl');
        Route::post('select-apl', 'MemberController@updateApl');

        Route::get('/', 'BackendController@dashboard');
        Route::get('favorites', 'BackendController@favorites');
        Route::get('pins', 'BackendController@pins');
        
        Route::get('contact/{role}', 'MemberController@contact')->name('member.contact');
        Route::post('contact/{role}', 'MemberController@sendMail');
        
        Route::get('purchases', 'MemberController@purchases')->name('member.purchases');
        Route::get('orders', 'MemberController@orders')->name('member.orders');
        Route::get('cart/{cart}', 'MemberController@showCart')->name('member.cart');
    });
    
});

Route::prefix('afa')->middleware(["auth","role:afa"])->group(function(){
    
    Route::get('/', 'BackendController@dashboard');
    Route::get('favorites', 'BackendController@favorites');
    Route::get('pins', 'BackendController@pins');
    
    Route::get('orders', 'AfaController@orders')->name('afa.orders');
    Route::get('sales', 'AfaController@sales')->name('afa.sales');
    
});

Route::prefix('apl')->middleware(["auth","role:apl"])->group(function(){
    
    Route::get('/', 'BackendController@dashboard');
    Route::get('favorites', 'BackendController@favorites');
    Route::get('pins', 'BackendController@pins');
    
    Route::get('orders', 'AplController@orders')->name('apl.orders');
    Route::get('sales', 'AplController@sales')->name('apl.sales');
    Route::get('customers', 'AplController@customers')->name('apl.customers');
    
});

Route::prefix('seller')->middleware(["auth","role:seller"])->group(function(){
    
    Route::get('/', 'BackendController@dashboard');
    Route::get('favorites', 'BackendController@favorites');
    Route::get('pins', 'BackendController@pins');
    
    Route::get('products', 'SellerController@products')->name('seller.products');
    
});

Route::prefix('admin')->middleware(["auth","role:admin"])->group(function(){
    
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/chart/{type}', 'AdminController@chart')->name('admin.chart');

    Route::get('card', 'AdminController@card')->name('admin.card');
    Route::get('carts/{filter?}', 'CartController@allAdmin')->name('admin.cart.list');
    Route::get('cart/{cart}', 'CartController@index')->name('admin.cart.show');

    // Blog Controller Groups
    Route::get('blogs/{filter?}', 'BlogController@allAdmin')->name('admin.blog.list');
    Route::prefix('blog')->group(function(){
        Route::get('/', 'BlogController@create')->name('admin.blog.create');
        Route::post('/', 'BlogController@store')->name('admin.blog.store');
        Route::get('update/{blog}', 'BlogController@edit')->name('admin.blog.edit');
        Route::post('update/{blog}', 'BlogController@update')->name('admin.blog.update');
        Route::get('publish/{blog}', 'BlogController@publish')->name('admin.blog.publish');
        Route::get('archive/{blog}', 'BlogController@archive')->name('admin.blog.archive');
        Route::get('trash/{blog}', 'BlogController@trash')->name('admin.blog.trash');
        Route::get('restore/{blog}', 'BlogController@restore')->name('admin.blog.restore');
        Route::get('star/{blog}', 'BlogController@star')->name('admin.blog.star');
        Route::get('delete/{blog}', 'BlogController@delete')->name('admin.blog.delete');
    });

    // Comment Controller Groups
    Route::get('comments/{blog}/{filter?}', 'CommentController@all')->name('admin.comment.list');
    Route::prefix('comment')->group(function(){
        Route::get('show/{comment}', 'CommentController@show')->name('admin.comment.show');
        Route::get('publish/{comment}', 'CommentController@publish')->name('admin.comment.publish');
        Route::get('archive/{comment}', 'CommentController@archive')->name('admin.comment.archive');
        Route::get('trash/{comment}', 'CommentController@trash')->name('admin.comment.trash');
        Route::get('restore/{comment}', 'CommentController@restore')->name('admin.comment.restore');
        Route::get('delete/{comment}', 'CommentController@delete')->name('admin.comment.delete');
    });

    // Product Controller Groups
    Route::get('products/{filter?}', 'ProductController@all')->name('admin.product.list');
    Route::prefix('product')->group(function(){
        Route::get('show/{product}', 'ProductController@show')->name('admin.product.show');
        Route::get('publish/{product}', 'ProductController@publish')->name('admin.product.publish');
        Route::get('archive/{product}', 'ProductController@archive')->name('admin.product.archive');
        Route::get('trash/{product}', 'ProductController@trash')->name('admin.product.trash');
        Route::get('restore/{product}', 'ProductController@restore')->name('admin.product.restore');
        Route::get('delete/{product}', 'ProductController@delete')->name('admin.product.delete');
    });

    // Category Controller Groups
    Route::get('categories/{filter?}', 'CategoryController@allAdmin')->name('admin.category.list');
    Route::prefix('category')->group(function(){
        Route::get('/', 'CategoryController@create')->name('admin.category.create');
        Route::post('/', 'CategoryController@store')->name('admin.category.store');
        Route::get('show/{category}', 'CategoryController@show')->name('admin.category.show');
        Route::get('update/{category}', 'CategoryController@edit')->name('admin.category.edit');
        Route::post('update/{category}', 'CategoryController@update')->name('admin.category.update');
        Route::get('delete/{category}', 'CategoryController@delete')->name('admin.category.delete');
    });

    // User Controller Groups
    Route::get('users/{filter?}', 'UserController@all')->name('admin.user.list');
    Route::prefix('user')->group(function(){
        Route::get('/', 'UserController@create')->name('admin.user.create');
        Route::post('/', 'UserController@store')->name('admin.user.store');
        Route::get('show/{user}', 'UserController@show')->name('admin.user.show');
        Route::post('show/{user}', 'ObservationController@store')->name('admin.user.observe');
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
        Route::get('show/{page}', 'PageController@show')->name('admin.page.show');
        Route::get('update/{page}', 'PageController@edit')->name('admin.page.edit');
        Route::post('update/{page}', 'PageController@update')->name('admin.page.update');
        Route::get('delete/{page}', 'PageController@delete')->name('admin.page.delete');
    });

    // Pub Controller Groups
    Route::get('pubs/{filter?}', 'PubController@allAdmin')->name('admin.pub.list');
    Route::prefix('pub')->group(function(){
        Route::get('/', 'PubController@create')->name('admin.pub.create');
        Route::post('/', 'PubController@store')->name('admin.pub.store');
        Route::get('show/{pub}', 'PubController@show')->name('admin.pub.show');
        Route::get('update/{pub}', 'PubController@edit')->name('admin.pub.edit');
        Route::post('update/{pub}', 'PubController@update')->name('admin.pub.update');
        Route::get('detach/{pub}/{page}', 'PubController@detach')->name('admin.pub.detach');
        Route::get('delete/{pub}', 'PubController@delete')->name('admin.pub.delete');
    });

    // Bad WOrds Controller Groups
    Route::get('badwords', 'BadWordController@all')->name('admin.badword.list');
    Route::prefix('badword')->group(function(){
        Route::get('/', 'BadWordController@create')->name('admin.badword.create');
        Route::post('/', 'BadWordController@store')->name('admin.badword.store');
        Route::get('update/{badword}', 'BadWordController@edit')->name('admin.badword.edit');
        Route::post('update/{badword}', 'BadWordController@update')->name('admin.badword.update');
        Route::get('delete/{badword}', 'BadWordController@delete')->name('admin.badword.delete');
    });

    // Code Postal Controller Groups
    Route::get('postal-codes', 'PostalCodeController@all')->name('admin.postalcode.list');
    Route::prefix('postal-code')->group(function(){
        Route::get('/', 'PostalCodeController@create')->name('admin.postalcode.create');
        Route::post('/', 'PostalCodeController@store')->name('admin.postalcode.store');
        Route::get('update/{postalcode}', 'PostalCodeController@edit')->name('admin.postalcode.edit');
        Route::post('update/{postalcode}', 'PostalCodeController@update')->name('admin.postalcode.update');
        Route::get('delete/{postalcode}', 'PostalCodeController@delete')->name('admin.postalcode.delete');
    });

    // State Controller Groups
    Route::get('states', 'StateController@all')->name('admin.state.list');
    Route::prefix('state')->group(function(){
        Route::get('/', 'StateController@create')->name('admin.state.create');
        Route::post('/', 'StateController@store')->name('admin.state.store');
        Route::get('update/{state}', 'StateController@edit')->name('admin.state.edit');
        Route::post('update/{state}', 'StateController@update')->name('admin.state.update');
        Route::get('delete/{state}', 'StateController@delete')->name('admin.state.delete');
    });

    // Chat Controller Groups
    Route::get('chats/{filter?}', 'ThreadController@all')->name('admin.chat.list');
    Route::prefix('chat')->group(function(){
        Route::get('show/{thread}', 'ThreadController@show')->name('admin.thread.show');
        Route::get('delete/{thread}', 'ThreadController@delete')->name('admin.thread.delete');
    });
    
    // Observation Controller Groups
    Route::get('observations/{filter?}', 'ObservationController@allAdmin')->name('admin.observation.list');
    Route::prefix('observation')->group(function(){
        Route::get('update/{observation}', 'ObservationController@edit')->name('admin.observation.edit');
        Route::post('update/{observation}', 'ObservationController@update')->name('admin.observation.update');
        Route::get('delete/{observation}', 'ObservationController@delete')->name('admin.observation.delete');
        Route::get('restore/{observation}', 'ObservationController@restore')->name('admin.observation.restore');
    });

    // Config Controller
    Route::prefix('config')->group(function () {
        Route::get('site', 'ConfigController@site')->name('config.site');
        Route::post('site', 'ConfigController@site')->name('config.site.update');
        Route::get('login', 'ConfigController@login')->name('config.login');
        Route::post('login', 'ConfigController@login')->name('config.login.update');
        Route::get('social', 'ConfigController@social')->name('config.social');
        Route::post('social', 'ConfigController@social')->name('config.social.update');
        Route::get('payment', 'ConfigController@payment')->name('config.payment');
        Route::post('payment', 'ConfigController@payment')->name('config.payment.update');
        Route::get('fontawesome', 'ConfigController@fontawesome')->name('config.fontawesome');
    });
    
    //Mail
    Route::prefix('mail')->group(function(){
        Route::get('/{user}', 'MailController@contact')->name('admin.mail.send');
        Route::post('/{user}', 'MailController@sendMail');
        Route::get('delete/{mail}', 'MailController@delete')->name('mail.delete');
    });

});
