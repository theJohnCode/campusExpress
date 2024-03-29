<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

/* 
todo|--------------------------------------------------------------
!           FRONTEND SECTION
todo|--------------------------------------------------------------
*/ 

Route::get('/', [IndexController::class,'home'])->name('home');
Route::get('product-category/{slug}', [IndexController::class,'productCategory'])->name('product.category');
Route::get('product-details/{slug}/', [IndexController::class, 'productDetails'])->name('product.details');


/* 
todo|--------------------------------------------------------------
!           END FRONTEND SECTION
todo|--------------------------------------------------------------
*/ 

Auth::routes(['register' => false]);

// ? User Authentication
Route::get('user/auth', [IndexController::class,'userAuth'])->name('user.auth');
Route::post('user/login',[IndexController::class,'login'])->name('login.submit');
Route::post('user/register',[IndexController::class,'register'])->name('register.submit');
Route::get('user/logout',[IndexController::class,'logout'])->name('user.logout');

Route::get('/home', [HomeController::class, 'index'])->name('index');


/* 
todo|--------------------------------------------------------------
!           ADMIN SECTION
todo|--------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function(){
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    // Banner Section
    Route::resource('banner', BannerController::class);
    Route::post('/banner_status', [BannerController::class,'bannerStatus'])->name('banner.status');

    // Category Section
    Route::resource('category', CategoryController::class);
    Route::post('/category_status', [CategoryController::class,'categoryStatus'])->name('category.status');
    Route::post('category/{id}/child',[CategoryController::class, 'getChildParentID']);

    // Brand Section
    Route::resource('brand', BrandController::class);
    Route::post('/brand_status', [BrandController::class,'brandStatus'])->name('brand.status');
    
    // Product Section
    Route::resource('product', ProductController::class);
    Route::post('/product_status', [ProductController::class,'productStatus'])->name('product.status');

    // User Section
    Route::resource('user', UserController::class);
    Route::post('/user_status', [UserController::class,'userStatus'])->name('user.status');
});

/* 
todo|--------------------------------------------------------------
!           ADMIN SECTION END
todo|--------------------------------------------------------------
*/





/* 
todo|--------------------------------------------------------------
!           SELLER SECTION START
todo|--------------------------------------------------------------
*/

Route::group(['prefix' => 'seller', 'middleware' => ['auth','seller']], function(){
    Route::get('/', [AdminController::class, 'admin'])->name('seller');
});

/* 
todo|--------------------------------------------------------------
!           SELLER SECTION END
todo|--------------------------------------------------------------
*/


/* 
todo|--------------------------------------------------------------
!           USER SECTION START
todo|--------------------------------------------------------------
*/

Route::group(['prefix' => 'user'], function(){
    Route::get('/dashboard', [IndexController::class, 'userAccount'])->name('user.dashboard');
});

/* 
todo|--------------------------------------------------------------
!           USER SECTION END
todo|--------------------------------------------------------------
*/