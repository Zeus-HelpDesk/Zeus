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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/emoji', 'EmojiController@index');

Route::group(['prefix' => '/webhooks'], function () {
    Route::post('/email/postal');
    Route::post('/email/sendgrid');
    Route::post('/email/mailgun');
});
