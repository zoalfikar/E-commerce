<?php
use App\Http\Controllers\frontend\frontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\wishlistController;
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

//routes for products and categories
Route::get('/',[frontendController::class,'index']);
Route::get('/showCategories',[frontendController::class,'showCategories']);
Route::get('/productsOfCateg/{slug}',[frontendController::class,'productsOfCateg']);
Route::get('/productDetails/{cat_slug}/{prod_slug}',[frontendController::class,'productDetails']);







Route::middleware(['auth'])->group(function()
{       //routes for cart

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

 });




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth','isAdmin']], function () {

    Route::get('/dashboard', [App\Http\Controllers\admin\FrontendController::class, 'index']);
    //////
    Route::get('/category', [App\Http\Controllers\admin\CategoryConroller::class, 'index']);
    Route::get('/add-category' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'addCategory']);
    Route::post('/insert-category' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'insertCategory']);
    Route::get('/edit-category/{id}' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'editCategory']);
    Route::post('/edit-category/{id}' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'updateCategory']);
    Route::get('/delete-category/{id}' ,  [App\Http\Controllers\admin\CategoryConroller::class, 'deleteCategory']);
    //////
    Route::get('/products', [App\Http\Controllers\admin\ProductController::class, 'index']);
    Route::get('/add-product' ,  [App\Http\Controllers\admin\ProductController::class, 'addProduct']);
    Route::post('/insert-product' ,  [App\Http\Controllers\admin\ProductController::class, 'insertProduct']);
    Route::get('/edit-product/{id}' ,  [App\Http\Controllers\admin\ProductController::class, 'editProduct']);
    Route::post('/edit-product/{id}' ,  [App\Http\Controllers\admin\ProductController::class, 'updateProduct']);
    Route::get('/delete-product/{id}' ,  [App\Http\Controllers\admin\ProductController::class, 'deleteProduct']);
    ///////
    Route::get('/order-list', [App\Http\Controllers\admin\FrontendController::class, 'orderList']);
    Route::get('/d-order-details/{id}', [App\Http\Controllers\admin\FrontendController::class, 'orderDetail']);
    Route::post('/update-order/{id}', [App\Http\Controllers\admin\FrontendController::class, 'updateOrder']);
    /////users
    Route::get('/users', [App\Http\Controllers\admin\FrontendController::class, 'users']);
    Route::get('/user-detail/{id}', [App\Http\Controllers\admin\FrontendController::class, 'userDetails']);
});
