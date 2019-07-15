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

Route::get('/home', 'HomeController@index');





















Route::resource('users', 'UserController');

Route::resource('sessions', 'SessionController');

Route::resource('deviceTypes', 'DeviceTypeController');

Route::resource('devices', 'DeviceController');

Route::resource('instances', 'InstanceController');



Route::resource('attributeGroups', 'AttributeGroupController');



Route::resource('attributes', 'AttributeController');

Route::resource('attributables', 'AttributableController');