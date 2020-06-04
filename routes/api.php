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

Route::apiResource('/category', 'CategoryController');

Route::apiResource('/article', 'ArticleController');

// These routes required a token to be accessed
Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('/logout', 'AuthController@logout');

    Route::post('/userdata','AuthController@getAuthUser');

});
