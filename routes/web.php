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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', function () {return view('dashboard-home');})->name('dashboard-home');

Route::prefix('admin')->group(function() {
    Route::get('/','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/home', 'Auth\AdminController@index')->name('admin.dashboard');
    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/users','UsersController@index')->name('view-users');
    ////////////////////////////////////////////////////////
    Route::get('/categories','Admin\CategoryController@index')->name('view-categories');
    Route::get('/categories/create','Admin\CategoryController@create')->name('create-category');
    Route::post('/categories','Admin\CategoryController@store')->name('store-category');
    Route::get('/categories/{category}','Admin\CategoryController@show')->name('admin-show-category');
    Route::get('/categories/{category}/edit','Admin\CategoryController@edit')->name('admin-edit-category');
    Route::patch('/categories/{category}','Admin\CategoryController@update')->name('admin-update-category');
    Route::delete('/categories/{id}','Admin\CategoryController@destroy')->name('admin-destroy-category');
    Route::get('/categories/{category}/create-sub-cat','Admin\SubCategoryController@create')->name('admin-create-sub-category');
    Route::post('/categories/{category}','Admin\SubCategoryController@store')->name('admin-store-sub-category');
    /////////////////////////////////////////////////////////
    Route::get('/countries/create','Admin\CountryController@create')->name('admin-create-country');
    Route::post('/countries','Admin\CountryController@store')->name('admin-store-country');
    Route::get('/countries','Admin\CountryController@index')->name('view-countries');
    Route::get('/countries/{country}','Admin\CountryController@show')->name('admin-show-country');
    Route::get('/countries/{country}/edit','Admin\CountryController@edit')->name('admin-edit-country');
    Route::patch('/countries/{country}','Admin\CountryController@update')->name('admin-update-country');
    Route::get('/countries/{country}/create-city','Admin\CityController@create')->name('admin-create-city');
    Route::post('/countries/{country}','Admin\CityController@store')->name('admin-store-city');
    ////////////////////////////////////////////////////////
    Route::get('/products','Admin\ProductsController@index')->name('admin-view-products');
    Route::get('/products/{product}','Admin\ProductsController@show')->name('admin-view-product_details');
    Route::post('/products','Admin\ProductsController@filter')->name('admin-filter-products');

   }) ;
