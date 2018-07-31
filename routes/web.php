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
})->name('welcome');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings');
Route::post('/settings');

Route::get('/user/:user');

Route::group(['prefix' => '/ticket'], function () {
    Route::get('/create');
    Route::get('/:ticket');
    Route::get('/:ticket/edit');
    Route::post('/:ticket/edit');
});


Route::group(['prefix' => '/admin'], function () {
    Route::get('/');
    Route::get('/locations');
    Route::get('/locations/:district');
    Route::get('/locations/:district/:building');
    Route::get('/help-desk/status');
    Route::get('/help-desk/category');
});