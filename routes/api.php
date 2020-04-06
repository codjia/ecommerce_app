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

Route::post('login','API\LoginController@login')->name('login');// user login
Route::post('register','API\RegisterController@register')->name('register');// user registeration

Route::group(['middleware' => ['auth:api']], function () {

    //Products
    Route::get('get_products','API\ProductController@index')->name('get_products');// Get products data    
    Route::post('get_products/create','API\ProductController@create')->name('get_products/create');// Create new products data

    //Categories
    Route::get('get_categories','API\CategoryController@index')->name('get_categories');// Get all Category
    Route::get('get_categories/{id}','API\CategoryController@show');// Category data
    Route::post('get_categories/create','API\CategoryController@create')->name('get_categories.create');// Create new Category
});




// https://www.unicaf.org/scholarships/partners-programmes/