<?php

use App\Http\Controllers\ResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController as adminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Person\OrderController as personOrderController;

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

//Авторизации
Auth::routes([
    'reset' => False,
    'confirm' => False,
    'verify' => False,
]);


Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->name('get-logout');
});


// Главные страницы
Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/categories', 'categories')->name('categories');

    Route::get('/categories/{code}', 'category')->name('category');

    Route::get('categories/{category}/{product}', 'product')->name('product');
});

// Админ панель
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function (){

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    //Обнуление
    Route::get('/reset',[ResetController::class, 'reset'])->name('reset');

    Route::namespace('Admin')->group(function () {

        Route::get('/orders/{order}', [adminOrderController::class, 'show'])->name('orders.show');

        Route::get('/orders', [adminOrderController::class, 'index'])->name('home');

    });


});

//Работа с корзиной
Route::controller(BasketController::class)->prefix('basket')->group(function () {
    Route::post('/add/{id}', 'basketAdd')->name('basket-add');

    Route::middleware(['is_not_empty_cart'])->group(function (){
        Route::get('/', 'basket')->name('basket');

        Route::get('/place', 'order')->name('basket-place');

        Route::post('/place', 'basketConfirm')->name('basket-confirm');

        Route::post('/remove/{id}', 'basketRemove')->name('basket-remove');
    });
});


// Персональные данные
Route::group([
    'middleware' => 'auth',
    'namespace' => 'Person',
    'as' => 'person.',
    'prefix' => 'person',
], function () {
    Route::get('/orders', [personOrderController::class, 'index'])->name('orders.index');

    Route::get('/orders/{order}', [personOrderController::class, 'show'])->name('orders.show');
});
