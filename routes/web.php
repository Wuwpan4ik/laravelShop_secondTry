<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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

Auth::routes([
    'reset' => False,
    'confirm' => False,
    'verify' => False,
]);


Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->name('get-logout');
});

Route::resource('categories', CategoryController::class);

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function (){

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::namespace('Admin')->group(function () {
        Route::get('/home', [OrderController::class, 'index'])->name('home');
    });


});

Route::controller(BasketController::class)->prefix('basket')->group(function () {
    Route::post('/add/{id}', 'basketAdd')->name('basket-add');

    Route::middleware(['is_not_empty_cart'])->group(function (){
        Route::get('/', 'basket')->name('basket');

        Route::get('/place', 'order')->name('basket-place');

        Route::post('/place', 'basketConfirm')->name('basket-confirm');

        Route::post('/remove/{id}', 'basketRemove')->name('basket-remove');
    });
});

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/categories', 'categories')->name('categories');

    Route::get('/categories/{code}', 'category')->name('category');

    Route::get('/{category}/{product}', 'product')->name('product');
});
