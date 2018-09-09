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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings');
Route::post('/settings');

Route::get('/user/{user}');

Route::group(['prefix' => '/ticket', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/create');
    Route::get('/{ticket}');
    Route::get('/{ticket}/edit');
    Route::post('/{ticket}/edit');
});

/*
 * These routes are only accessible to IT staff
 */
Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'staff', 'verified']], function () {
    Route::get('/');
    // Manage locations
    Route::group(['prefix' => '/locations'], function () {
        Route::get('/', 'Locations\DistrictController@index');
        Route::get('/create', 'Locations\DistrictController@create');
        Route::post('/create', 'Locations\DistrictController@insert');
        Route::get('/{district}', 'Locations\DistrictController@single');
        Route::get('/{district}/edit', 'Locations\DistrictController@edit');
        Route::post('/{district}/edit', 'Locations\DistrictController@update');
        Route::get('/{district}/create', 'Locations\BuildingController@create');
        Route::post('/{district}/create', 'Locations\BuildingController@insert');
        Route::get('/{district}/{building}', 'Locations\BuildingController@index');
        Route::get('/{district}/{building}/edit', 'Locations\BuildingController@edit');
        Route::post('/{district}/{building}/edit', 'Locations\BuildingController@update');
    });
    // Manage Users
    Route::group(['prefix' => '/users'], function () {
        Route::get('/');
        Route::get('/create');
        Route::post('/create');
        Route::get('/{user}');
        Route::get('/{user}/edit');
        Route::post('/{user}/edit');
    });
    Route::get('/help-desk/status');
    Route::get('/help-desk/category');
});