<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::fallback(function(){
    return view('/errors/404');
});
Route::post('/registeration' ,'Api\AuthController@register');
Route::post('/login','Api\AuthController@login');
Route::post('/logout','Api\AuthController@logout');
Route::post('/update-password','api\AuthController@updatePassword');
Route::get('/categories','Api\CategoryController@index');
Route::post('/sub-category','Api\CategoryController@show');
Route::get('/banners','Api\BannersController@index');
Route::post('/products','Api\ProductsController@index');
Route::post('/product_details','Api\ProductsController@show');
Route::get('/countries','Api\CountryController@index');
Route::post('/cities','Api\CityController@show');
Route::post('/add-to-cart','Api\CartController@store');
Route::post('/cart','Api\CartController@show');
Route::post('/confirm-order','Api\OrderController@store');
Route::post('/remove_from_cart','Api\CartController@destroy');
Route::post('/mail','Api\SendEmailController@mail');
Route::post('/reset-password','Api\AuthController@reset');
Route::post('/send-code','Api\AuthController@sendCode');
Route::post('/verify-code','Api\AuthController@verifyCode');
