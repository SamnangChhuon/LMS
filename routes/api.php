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

Route::apiResources([ 
    'user' => 'API\UserController',
    'customer'  =>  'API\CustomerController',
    'product'  =>  'API\ProductController',
    'productCategory'  =>  'API\ProductCategoryController',
    'productType'  =>  'API\ProductTypeController',
    'file'  =>  'API\FileController',

    'income'  =>  'API\IncomeController',
    'incomeType'    =>  'API\IncomeTypeController',

    'expense'  =>  'API\ExpenseController',
    'expenseType'    =>  'API\ExpenseTypeController',
    ]);
    
Route::get('profile', 'API\UserController@profile');
Route::get('findUser', 'API\UserController@search');
Route::get('sortUsers', 'API\UserController@sortUsers');
Route::put('profile', 'API\UserController@updateProfile');

Route::post('inputFile/{cid}', 'API\FileController@storeFileById');
Route::get('showFile/{id}', 'API\FileController@showFile');

Route::get('getCustomers', 'API\CustomerController@getCustomers');
Route::post('customerAvatar/{id}', 'API\CustomerController@avatar');

Route::get('getProducts', 'API\ProductController@getProducts');
Route::get('getProduct/{id}', 'API\ProductController@getProduct');
