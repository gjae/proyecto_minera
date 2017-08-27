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


Auth::routes();

Route::get('/', function(){
	return view('index');
});


Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){

	Route::match(['get', 'post'],'/{modulo?}/{programa?}/{accion?}', 'Dashboard@index');

});
