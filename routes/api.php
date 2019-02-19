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

Route::group(['prefix' => 'category'], function(){
    Route::post('create',    'CategoryController@create');
    Route::post('delete',    'CategoryController@delete');
    Route::post('update',    'CategoryController@update');
    Route::get('list_all',    'CategoryController@listall');
    Route::get('list_by_id',    'CategoryController@listById');

});

Route::group(['prefix' => 'application'], function(){
    Route::post('create',    'ApplicationsController@create');
    Route::post('delete',    'ApplicationsController@delete');
    Route::post('update',    'ApplicationsController@update');
    Route::get('list_all',    'ApplicationsController@listall');

});

Route::group(['prefix' => 'item'], function(){
    Route::post('create',    'ItemController@create');
    Route::post('delete',    'ItemController@delete');
    Route::post('update',    'ItemController@update');
    Route::get('list_all',    'ItemController@listall');
    Route::get('list_by_id',    'ItemController@listById');

});

Route::group(['prefix' => 'media'], function(){
    Route::post('create',    'MediaController@create');
    Route::post('delete',    'MediaController@delete');
    Route::post('update',    'MediaController@update');
    Route::get('list_all',    'MediaController@listall');

});