<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => "rider", 'middleware' => [], 'namespace' => 'Rider'], function () {
    Route::post('/register', 'RiderRegisterController@register')->name('rider.register');
});

Route::group(['prefix' => "driver", 'middleware' => [], 'namespace' => 'Driver'], function () {
    Route::post('/register', 'DriverRegisterController@register')->name('driver.register');
    Route::put('/availability/{id}', 'DriverSettingController@availability')->name('driver.availability')->where('id', '[0-9]+');
});
