<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


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


Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/categories', 'categories')->name('categories');

    Route::get('categories/{code}', 'category')->name('category');

    Route::get('/product/{product}', 'product')->name('product');
});
