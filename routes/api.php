<?php


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

Route::group(['namespace' => 'Auth'], function () {
    Route::post('login', 'AuthorizationController@token')->name('login');
});

Route::get('test', function () {
    return 'test api';
});

Route::group(['middleware' => 'auth-api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::get('logout', 'AuthorizationController@logout')->name('logout');
        Route::get('user', 'AuthorizationController@userInfo')->name('user.info');
    });
});
