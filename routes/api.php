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

Route::group(['namespace' => 'Invitation'], function () {
    Route::post('invitations', 'InvitationController@store')->name('invitations.store');
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

/******************************* admin routes **************************************/

Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], function () {
    Route::group(['namespace' => 'Invitation'], function () {
        Route::get('invitations', 'InvitationController@index')->name('admin.invitations.index');
        Route::get('invitations/{invitation}', 'InvitationController@show')->name('admin.invitations.show');
        Route::delete('invitations/{invitation}', 'InvitationController@destroy')->name('admin.invitations.destroy');
    });
});
