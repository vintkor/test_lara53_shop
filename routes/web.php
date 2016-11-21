<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/home', 'HomeController@index');

/*================= Пользователь ===============*/

Route::get('/profile', ['as' => 'profile', 'uses' => 'UserController@index']);
Route::post('/profile', 'UserController@update_profile');

/*================= Новости ===============*/

Route::get('/news',                ['as' => 'news',        'uses' => 'NewsController@index']);
Route::get('/news/{slug}',         ['as' => 'single_news', 'uses' => 'NewsController@show']);
Route::post('/add_news',           ['as' => 'add_news',    'uses' => 'NewsController@create']);
Route::delete('/delete_news/{id}', ['as' => 'delete_news', 'uses' => 'NewsController@delete']);

/*================= Новости ===============*/

Route::post('/add_marker', ['as' => 'add_marker', 		'uses' => 'MarkerController@add_marker']);
Route::get('/add_marker',  ['as' => 'add_new_marker',   'uses' => 'MarkerController@add_new_marker']);

