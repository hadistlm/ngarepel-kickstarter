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
// make sure user has login to access these URL
Route::group(['middleware' => 'auth'], function() {
	//Home URL
	Route::get('/home', 'HomeController@index')->name('home');
	// Route Logout
    Route::get('logout', 'Auth\LoginController@logout');
    // Route For Dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    // Routes for Setting
	Route::resource('setting', 'SettingController');
});