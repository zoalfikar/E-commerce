<?php
use App\Http\Controllers\frontend\frontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\wishlistController;
use App\Http\Controllers\Frontend\RateController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\StoresController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

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
Route::get('/test',function ( ) {
//

// return asset('assets/uploads/product/1652808756.png');
return storeOwner();
// return asset('storesLogo/1653142189.jpg');
// return 'any';

});

Route::middleware(['guest','lang'])->group( function () {

    //routes for products and categories
    Route::get('/',[frontendController::class,'index']);
    Route::get('/showCategories',[frontendController::class,'showCategories']);
    Route::get('/show-all-categories',[frontendController::class,'showAllCategories']);
    Route::get('/productsOfCateg/{slug}',[frontendController::class,'productsOfCateg']);
    Route::get('/productDetails/{cat_slug}/{prod_slug}',[frontendController::class,'productDetails']);
    //stores route
    Route::get('/stores',[StoresController::class,'index']);
    Route::get('/storeDetails/{slug}',[StoresController::class,'storeDetails']);
    //for search
    Route::get('/search-products',[frontendController::class,'searchForProducts']);
    Route::post('/get-product',[frontendController::class,'getProduct']);
    //change language
    Route::post('/chang-lang', [App\Http\Controllers\admin\LanguagesController::class, 'changeLanguage']);

});

Route::middleware(['auth','verified','lang'])->group(function()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //routes for cart
    Route::get('/cart', [CartController::class,'showCart']);
    Route::post('/add-to-cart',[CartController::class,'addProduct']);
    Route::post('/delet-from-cart',[CartController::class,'deletProduct']);
    Route::post('/update-cart',[CartController::class,'updateProduct']);
    Route::get('/get-cart-count', [CartController::class,'CartCount']);
    ///////
    Route::get('/orders', [UserController::class,'index']);
    Route::get('/order-details/{id}', [UserController::class,'orderDetails']);
    ////
    Route::get('/wishlist', [wishlistController::class,'wishlist']);
    Route::post('/add-to-wishlist', [wishlistController::class,'addTOwishlist']);
    Route::post('/delet-from-wishlist',[wishlistController::class,'deletFromWishlis']);
    Route::get('/get-wishlist-count', [wishlistController::class,'wishlistCount']);

    ////routes for checkout
    Route::get('/checkout', [CheckoutController::class,'index']);
    Route::post('/placeholder', [CheckoutController::class,'placeholder']);
    Route::post('/proceed-to-pay', [CheckoutController::class,'razorpay']);
    //// rating the products
    Route::post('/rate-product', [RateController::class,'rate']);
    ////review
    Route::get('/add-reviw/{slug}/user-review', [ReviewController::class,'Reviw']);
    Route::post('/add-reviw', [ReviewController::class,'addReviw']);
    Route::get('/edit-reviw/{slug}/user-review', [ReviewController::class,'editReviw']);
    ////complaints
    Route::get('/add-complain/{id}',[frontendController::class,'complain']);
    Route::post('/complain',[frontendController::class,'sendComplain']);
    ////stores
    Route::get('/new-store',[StoresController::class,'newStore']);
    Route::post('/create-store',[StoresController::class,'createStore']);
    Route::get('/store-panel',[StoresController::class,'showCP']);
    Route::get('/store-categores',[StoresController::class,'CategoriesIndex']);
    Route::get('/store-add-category',[StoresController::class,'addCategory']);
    Route::post('/store-insert-category',[StoresController::class,'insertCategory']);
    Route::get('/store-edit-category/{id}',[StoresController::class,'editCategory']);
    Route::get('/store-products',[StoresController::class,'ProductsIndex']);
    Route::get('/store-add-product',[StoresController::class,'addProduct']);
    Route::post('/store-insert-product',[StoresController::class,'insertProduct']);
    Route::get('/store-edit-product/{id}',[StoresController::class,'editProduct']);

});


Auth::routes(['verify' => true]);


Route::group(['middleware' => ['auth','isAdmin','lang']], function () {

    Route::get('/dashboard', [App\Http\Controllers\admin\FrontendController::class, 'index']);
    //////
    Route::get('/category', [App\Http\Controllers\admin\CategoryConroller::class, 'index']);
    Route::get('/add-category' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'addCategory']);
    Route::post('/insert-category' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'insertCategory']);
    Route::get('/edit-category/{id}' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'editCategory']);
    Route::post('/edit-category/{id}' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'updateCategory']);
    Route::get('/delete-category/{id}' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'deleteCategory']);
    Route::get('/translet-category/{id}/{abbe}' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'transletIndexCategory']);
    Route::post('/translet-category' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'transeletCategory']);
    Route::post('/active-category' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'activeCategory']);
    Route::post('/prevent-category' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'preventCategory']);
    //////
    Route::get('/products', [App\Http\Controllers\admin\ProductController::class, 'index']);
    Route::get('/add-product' ,  [App\Http\Controllers\admin\ProductController::class, 'addProduct']);
    Route::post('/insert-product' ,  [App\Http\Controllers\admin\ProductController::class, 'insertProduct']);
    Route::get('/edit-product/{id}' ,  [App\Http\Controllers\admin\ProductController::class, 'editProduct']);
    Route::post('/edit-product/{id}' ,  [App\Http\Controllers\admin\ProductController::class, 'updateProduct']);
    Route::get('/delete-product/{id}' ,  [App\Http\Controllers\admin\ProductController::class, 'deleteProduct']);
    Route::get('/translet-product/{id}/{abbe}' ,  [App\Http\Controllers\admin\ProductController::class, 'transletIndexProduct']);
    Route::post('/trending-product' ,  [App\Http\Controllers\admin\ProductController::class, 'trendingProduct']);
    Route::post('/active-product' ,  [App\Http\Controllers\admin\ProductController::class, 'activeProduct']);
    Route::post('/prevent-product' ,  [App\Http\Controllers\admin\ProductController::class, 'preventProduct']);
    ///////
    Route::get('/order-list', [App\Http\Controllers\admin\FrontendController::class, 'orderList']);
    Route::get('/d-order-details/{id}', [App\Http\Controllers\admin\FrontendController::class, 'orderDetail']);
    Route::post('/update-order/{id}', [App\Http\Controllers\admin\FrontendController::class, 'updateOrder']);
    /////users
    Route::get('/users', [App\Http\Controllers\admin\FrontendController::class, 'users']);
    Route::get('/user-detail/{id}', [App\Http\Controllers\admin\FrontendController::class, 'userDetails']);
    Route::get('/complaimts', [App\Http\Controllers\admin\FrontendController::class, 'showcomplaints']);
    //languages
    Route::get('/languages', [App\Http\Controllers\admin\LanguagesController::class, 'index']);
    Route::get('/add-language', [App\Http\Controllers\admin\LanguagesController::class, 'addLanguage']);
    Route::post('/insert-language', [App\Http\Controllers\admin\LanguagesController::class, 'insertLanguage']);
    Route::get('/edit-language/{id}', [App\Http\Controllers\admin\LanguagesController::class, 'editeLanguage']);
    Route::post('/update-language/{id}', [App\Http\Controllers\admin\LanguagesController::class, 'updateLanguage']);
    Route::get('/delet-language/{id}', [App\Http\Controllers\admin\LanguagesController::class, 'deletLanguage']);
    //notifications
    Route::post('/active-store', [App\Http\Controllers\admin\NotificationsController::class, 'activeStore']);
    Route::post('/delet-store', [App\Http\Controllers\admin\NotificationsController::class, 'deletStore']);
});
