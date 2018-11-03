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

Route::group(['prefix' => '/ticket', 'middleware' => ['auth', 'verified'], 'namespace' => 'HelpDesk\Tickets'], function () {
    Route::get('/create', 'TicketController@create');
    Route::post('/create', 'TicketController@insert');
    Route::get('/{ticket}', 'TicketController@index');
    Route::get('/{ticket}/edit', 'TicketController@edit');
    Route::post('/{ticket}/edit', 'TicketController@update');
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
    Route::group(['prefix' => '/users', 'middleware' => ['auth', 'staff', 'verified']], function () {
        Route::get('/');
        Route::get('/create');
        Route::post('/create');
        Route::get('/{user}');
        Route::get('/{user}/edit');
        Route::post('/{user}/edit');
    });

    Route::group(['prefix' => '/help-desk', 'middleware' => ['auth', 'staff', 'verified'], 'namespace' => 'HelpDesk\Meta'], function () {
        Route::group(['prefix' => '/status'], function () {
            Route::get('/', 'StatusController@index');
            Route::get('/create', 'StatusController@create');
            Route::post('/create', 'StatusController@insert');
            Route::get('/edit/{status}', 'StatusController@edit');
            Route::post('/edit/{status}', 'StatusController@update');
        });

        Route::group(['prefix' => '/category'], function () {
            Route::get('/', 'CategoryController@index');
            Route::get('/create', 'CategoryController@create');
            Route::post('/create', 'CategoryController@insert');
            Route::get('/edit/{category}', 'CategoryController@edit');
            Route::post('/edit/{category}', 'CategoryController@update');
        });

        Route::group(['prefix' => '/priority'], function () {
            Route::get('/', 'PriorityController@index');
            Route::get('/create', 'PriorityController@create');
            Route::post('/create', 'PriorityController@insert');
            Route::get('/edit/{priority}', 'PriorityController@edit');
            Route::post('/edit/{priority}', 'PriorityController@update');
        });
    });
});
