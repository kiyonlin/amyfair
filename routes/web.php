<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{locale}/invitation', function ($locale) {
    App::setLocale($locale);
    return view('invitation.index');
})->name('invitation');

Route::get('{locale}/invitation/create', function ($locale) {
    return view('invitation.create');
})->name('invitation.create');
