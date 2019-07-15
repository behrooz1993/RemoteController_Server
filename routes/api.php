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

Route::group([
    'prefix' => 'auth',
], function ($router) {
  // any route that should be behind authentication and showable to new users
  // with incomplete profiles, goes here
    Route::post('login', 'AuthAPIController@login')
        ->middleware('throttle.login');
    Route::post('verify', 'AuthAPIController@verify');
    Route::post('complete-profile', 'AuthAPIController@completeProfile');
    Route::post('tfa', 'AuthAPIController@secondFactor');
    Route::get('refresh', 'AuthAPIController@refresh');
    Route::get('logout', 'AuthAPIController@logout');
});













Route::resource('users', 'UserAPIController');

Route::resource('sessions', 'SessionAPIController');

Route::resource('device_types', 'DeviceTypeAPIController');

Route::resource('devices', 'DeviceAPIController');

Route::resource('instances', 'InstanceAPIController');



Route::resource('attribute_groups', 'AttributeGroupAPIController');



Route::resource('attributes', 'AttributeAPIController');

Route::resource('attributables', 'AttributableAPIController');