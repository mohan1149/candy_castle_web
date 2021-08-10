<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/update-order', 'App\Http\Controllers\OrderController@updateOrder');


//app routes
Route::post('/user/login', 'App\Http\Controllers\UserController@userLogin');
Route::get('/get/products', 'App\Http\Controllers\ProductController@getProducts');
Route::post('/add/customer','App\Http\Controllers\CustomerController@addCustomer');
Route::post('/customer/login','App\Http\Controllers\CustomerController@login');
Route::post('/place-order','App\Http\Controllers\OrderController@placeOrder');
Route::get('/get/orders/{user}','App\Http\Controllers\OrderController@getOrders');
Route::get('/get/services','App\Http\Controllers\ServiceController@getServices');
Route::get('/get/services-categories','App\Http\Controllers\ServiceCategoryController@getServiceCategories');
Route::get('/get/product-categories','App\Http\Controllers\CategoryController@getCategories');
Route::get('/get-charge','App\Http\Controllers\SettingsController@getCharge');
Route::get('/get/app-dashboard','App\Http\Controllers\SettingsController@appDashboard');
