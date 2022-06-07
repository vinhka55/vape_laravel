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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//comment
Route::post('/comment','App\Http\Controllers\CommentController@add')->name('api.add_comment');
Route::get('/comment/{idProduct}','App\Http\Controllers\CommentController@show')->name('api.show_comment');
Route::delete('/comment/{idProduct}','App\Http\Controllers\CommentController@delete')->name('api.delete_comment');

