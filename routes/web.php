<?php

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

// admin routes
Route::get('/admin/login', function () {
    return view('welcome');
});
Route::post('/admin/login','App\Http\Controllers\UserController@userLogin');
Route::middleware(['admin'])->group(function () {
    Route::get('/home', function () {
        return view('home.index');
    });
    Route::get('/settings', 'App\Http\Controllers\SettingsController@settings');
    Route::post('/set-shipping-charge', 'App\Http\Controllers\SettingsController@setShippingCharge');
    Route::post('/edit-shipping-charge', 'App\Http\Controllers\SettingsController@editShippingCharge');
    
    
});


// user routes
Route::get('/',function(){
    return view('employees.login');
});
Route::post('/','App\Http\Controllers\EmployeeController@login');
Route::middleware(['access'])->group(function () {
    Route::get('/lang','App\Http\Controllers\SettingsController@changeAppLanguage');
    Route::get('/dashboard','App\Http\Controllers\EmployeeController@dashboard');
    Route::resource('/salons', 'App\Http\Controllers\SalonController');
    Route::resource('/services', 'App\Http\Controllers\ServiceController');
    Route::resource('/products', 'App\Http\Controllers\ProductController');
    Route::resource('/categories', 'App\Http\Controllers\CategoryController');
    Route::resource('/employees', 'App\Http\Controllers\EmployeeController');
    Route::resource('/customers', 'App\Http\Controllers\CustomerController');
    Route::resource('/orders', 'App\Http\Controllers\OrderController');
    Route::resource('/service-categories', 'App\Http\Controllers\ServiceCategoryController');
    Route::get('/console', 'App\Http\Controllers\ConsoleController@console');
});



