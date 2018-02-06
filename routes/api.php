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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::match(['get', 'post'], "/instances" , "InstancesController@index");
Route::match(['get', 'post'], "/companies" , "CompaniesController@index");
Route::match(['get', 'post'], "/repositories" , "RepositoriesController@index");