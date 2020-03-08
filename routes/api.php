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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// These routes could be accessed without providing a token
Route::post('/login', 'AuthController@login');

Route::post('/register', 'AuthController@register');

Route::Resource('/category', 'CategoryController');
Route::get('/category/{id}', 'CategoryController@show');

Route::Resource('/article', 'ArticleController');
Route::get('/article/{id}', 'ArticleController@show');

// These routes required a token to be accessed
Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('/logout', 'AuthController@logout');

    Route::post('/userdata','AuthController@getAuthUser');

});
