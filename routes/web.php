<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin dashboard
Route::group(['prefix' => 'admin', 'middlware' => 'auth'], function(){
    Route::get('/',[AdminController::class, 'admin'])->name('admin');
    // Banner Section
    Route::resource('banner', BannerController::class);
    Route::post('banner_status', [BannerController::class,'bannerStatus'])->name('banner.status');
});