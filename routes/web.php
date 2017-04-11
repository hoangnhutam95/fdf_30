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
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'check.auth'], function () {
    Route::get('home', function () {
        return view('admin.master');
    });
    Route::resource('product', 'Admin\ProductController');
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('order', 'Admin\OrderController');
    Route::resource('user', 'Admin\UserController');
    Route::resource('suggest', 'Admin\SuggestController');
    Route::get('/update-status/{userId}', [
        'as' => 'product.status',
        'uses' => 'Admin\ProductController@updateStatus'
    ]);
});

Route::get('/', [
    'as' => 'frontend.product',
    'uses' => 'Frontend\ProductController@index',
    App::setLocale('vn'),
]);

Route::group(['middleware' => 'check.auth'], function () {
    App::setLocale('vn');
    Route::resource('profile', 'User\UserController');
});

Route::get('product-deltais/{id}', [
    'as' => 'frontend.product-deltais',
    'uses' => 'Frontend\ProductController@productDetails',
    App::setLocale('vn'),
]);

Route::get('shopping-cart/{id}', [
    'as' => 'shopping',
    'uses' => 'Frontend\ProductController@shopping',
    App::setLocale('vn'),
]);

Route::get('cart', ['as' => 'cart', 'uses' => 'Frontend\ProductController@cart']);

Route::get('remove-product-cart/{id}', [
    'as' => 'remove-product',
    'uses' => 'Frontend\ProductController@removeProduct'
]);

Route::post('order', ['as' => 'order', 'uses' => 'Frontend\ProductController@order']);

Route::get('product-category/{id}', [
    'as' => 'product-category',
    'uses' => 'Frontend\CategoryController@showProduct',
]);
