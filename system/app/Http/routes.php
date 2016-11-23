<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['fav']], function(){

	// Route::get('/', function () {
	//     return view('welcome');
	// });	

	Route::get('/', [
		'uses' => 'DealController@deal_list'
	]);

	Route::get('/deal_list', [
		'uses' => 'DealController@deal_list'
	]);

	Route::put('deal_list/{id}', [ 
		'middleware' => 'auth', 
		'uses' => 'DealController@fav_deal'
	]);

	Route::get('deal/{title}', [
		'uses' => 'DealController@deal'
	]);

	Route::get('/share_deal', [
		'middleware' => 'auth', 
		'uses' => 'DealController@share_deal_form'
	]);

	Route::post('/share_deal/post', [
		'middleware' => 'auth', 
		'uses' => 'DealController@share_deal_store'
	]);

	Route::get('/manage_deal', [
		'middleware' => 'auth', 
		'uses' => 'DealController@manage_deal'
	]);

	Route::put('manage_deal/edit/{id}', [ 
		'middleware' => 'auth', 
		'uses' => 'DealController@edit_deal'
	]);

	Route::put('manage_deal/delete/{id}', [ 
		'middleware' => 'auth', 
		'uses' => 'DealController@delete_deal'
	]);

	Route::get('/about_us', [
		'uses' => 'DealController@about_us'
	]);


	Route::auth();

	Route::get('/home', 'HomeController@index');

});