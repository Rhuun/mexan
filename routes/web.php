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
use App\Song;

Route::get('/Mexan/import','MexanController@import');
Route::get('/mexan/import','MexanController@import');

Route::get('/mexan','MexanController@index');
Route::get('/Mexan','MexanController@index');
Route::get('/mexan/index','MexanController@index');
Route::get('/Mexan/index','MexanController@index');

Route::get('/', function () {
  $test = ['bla bla 1', 'bla bla 2'];
    return view('welcome')->with('arrData', $test);
});