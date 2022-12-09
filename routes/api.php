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

Route::get('/mytest', function () {
    return response()->json([
        'person' => ['name' => '太郎', 'kana' => 'タロウ'],
    ]);
});

Route::group(['prefix' => 'user'], function(){
    Route::get('index', 'UserController@index')->name('user.index');
    Route::post('store', 'UserController@store')->name('user.store');
    Route::post('update','UserController@update')->name('user.update');
    Route::post('passwordUpdate','UserController@passwordUpdate')->name('user.passwordUpdate');
    Route::post('destroy','UserController@destroy')->name('user.destroy');
});

Route::group(['prefix' => 'category'], function(){
    Route::get('index', 'CategoryController@index')->name('category.index');
    Route::post('store', 'CategoryController@store')->name('category.store');
    Route::post('update','CategoryController@update')->name('category.update');
    Route::post('destroy','CategoryController@destroy')->name('category.destroy');
});

Route::group(['prefix' => 'status'], function(){
    Route::get('index', 'StatusController@index')->name('status.index');
    Route::post('store', 'StatusController@store')->name('status.store');
    Route::post('update','StatusController@update')->name('status.update');
    Route::post('destroy','StatusController@destroy')->name('status.destroy');
});

Route::group(['prefix' => 'task'], function(){
    Route::get('index', 'TaskController@index')->name('task.index');
    Route::post('store', 'TaskController@store')->name('task.store');
    Route::post('update','TaskController@update')->name('task.update');
    Route::post('destroy','TaskController@destroy')->name('task.destroy');
});

Route::group(['prefix' => 'comment'], function(){
    Route::post('index', 'CommentController@index')->name('comment.index');
    Route::post('store', 'CommentController@store')->name('comment.store');
});

Route::group(['prefix' => 'file'], function(){
    Route::post('store', 'FileController@store')->name('file.store');
});
