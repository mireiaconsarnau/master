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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');;


Route::get('/tasks/{opt}', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');
Route::get('/tasks/{opt}', 'TaskController@index');

Route::get('/trains', 'TrainUploadController@index');
Route::post('/train', 'TrainUploadController@store');
Route::delete('/train/{train}', 'TrainUploadController@destroy');

Route::get('/tests', 'TestUploadController@index');
Route::post('/test', 'TestUploadController@store');
Route::delete('/test/{test}', 'TestUploadController@destroy');