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

Route::post('/login',"AuthController@login")->name("login");

Route::get('/todos','App\Http\Controllers\TodosController@index');
Route::get('/todos/{id}','App\Http\Controllers\TodosController@show');
Route::post('/todos','App\Http\Controllers\TodosController@store');
Route::patch('/todos/{todo}','App\Http\Controllers\TodosController@update');
Route::patch('/todosCheckAll','App\Http\Controllers\TodosController@updateAll');
Route::delete('/todos/{todo}','App\Http\Controllers\TodosController@destroy');
Route::delete('/todosDeleteCompleted','App\Http\Controllers\TodosController@destroyCompleted');


// Route::apiResource('/books', 'App\Http\Controllers\BookController');
