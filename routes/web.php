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

Route::get('/user/{user}');

Route::group(['prefix' => '/ticket'], function () {
    Route::get('/create');
    Route::get('/{ticket}');
    Route::get('/{ticket}/edit');
    Route::post('/{ticket}/edit');
});

/*
 * These routes are only accessible to IT staff
 */
Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'staff']], function () {
    Route::get('/');
    Route::group(['prefix' => '/locations'], function () {
        Route::get('/', 'Locations\DistrictController@index');
        Route::get('/create');
        Route::post('/create');
        Route::get('/{district}', 'Locations\DistrictController@single');
        Route::get('/{district}/edit', 'Locations\DistrictController@edit');
        Route::post('/{district}/edit', 'Locations\DistrictController@update');
        Route::get('/{district}/create');
        Route::post('/{district}/create');
        Route::get('/{district}/{building}');
        Route::get('/{district}/{building}/edit');
        Route::post('/{district}/{building}/edit');
    });
    Route::get('/help-desk/status');
    Route::get('/help-desk/category');
});