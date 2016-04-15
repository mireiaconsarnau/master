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


Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');
Route::put('/task/{task}', 'TaskController@update');

Route::get('/trains', 'TrainUploadController@index');
Route::post('/train', 'TrainUploadController@store');
Route::delete('/train/{train}', 'TrainUploadController@destroy');
Route::put('/train/{train}', 'TrainUploadController@update');
Route::get('/train/view/{file}', 'TrainUploadController@download');

Route::get('/tests', 'TestUploadController@index');
Route::post('/test', 'TestUploadController@store');
Route::delete('/test/{test}', 'TestUploadController@destroy');
Route::put('/test/{test}', 'TestUploadController@update');
Route::get('/test/view/{file}', 'TestUploadController@download');

Route::get('/testsadmin', 'TestUploadAdminController@index');
Route::post('/testadmin', 'TestUploadAdminController@store');
Route::delete('/testadmin/{testadmin}', 'TestUploadAdminController@destroy');
Route::put('/testadmin/{testadmin}', 'TestUploadAdminController@update');
Route::post('/testadmin/analysis/{testadmin}', 'TestUploadAdminController@analysis');
Route::get('/testadmin/view/{file}', 'TestUploadAdminController@download');

Route::get('/users', 'UserController@index');
Route::post('/user', 'UserController@store');
Route::delete('/user/{user}', 'UserController@destroy');
Route::put('/user/{user}', 'UserController@update');