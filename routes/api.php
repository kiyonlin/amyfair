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

Route::group(['namespace' => 'Exhibition'], function () {
    Route::get('exhibitions/invitations', 'ExhibitionInvitationController@index')->name('exhibitions.invitations.index');
});

Route::get('test', function () {
    return 'test api';
});

Route::group(['middleware' => 'auth:api'], function () {
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
        Route::get('invitations/export', 'InvitationController@export')->name('admin.invitations.export');
    });

    Route::group(['namespace' => 'Exhibition'], function () {
        Route::get('exhibitions', 'ExhibitionController@index')->name('admin.exhibitions.index');
        Route::post('exhibitions', 'ExhibitionController@store')->name('admin.exhibitions.store');
        Route::get('exhibitions/{exhibition}', 'ExhibitionController@show')->name('admin.exhibitions.show');
        Route::put('exhibitions/{exhibition}', 'ExhibitionController@update')->name('admin.exhibitions.update');
        Route::delete('exhibitions/{exhibition}', 'ExhibitionController@destroy')->name('admin.exhibitions.destroy');
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::put('users/{admin}', 'AdminController@update')->name('admin.update');
    });
});
