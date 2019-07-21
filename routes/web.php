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

Route::get('/news', 'CurrentNewController@index');

Route::post('/news', 'CurrentNewController@store');

Route::get('/news/create', 'CurrentNewController@create');

Route::post('/news/edit', 'CurrentNewController@editStore');

Route::get('/news/edit/{news_id}', 'CurrentNewController@edit');

Route::get('/news/{news_id}', 'CurrentNewController@single');

Route::get('/news/delete/{news_id}', 'CurrentNewController@delete');




Route::get('/profile/{name}', 'UserController@myAccount');


Route::get('/projects', 'ProjectController@index');

Route::post('/projects', 'ProjectController@store');

Route::get('/projects/create', 'ProjectController@create');

Route::post('/projects/edit/', 'ProjectController@editStore');

Route::get('/projects/edit/{projectID}', 'ProjectController@edit');

Route::get('/projects/delete/{projectID}', 'ProjectController@delete');




Route::get('/steps/{name}/{id}', 'StepController@showSteps');

Route::post('/steps/', 'StepController@store');

Route::get('/steps/{name}/{id}/createStep', 'StepController@create');

Route::post('/steps/edit/', 'StepController@editStore');

Route::get('/steps/edit/{projectName}/{projectID}/{stepID}', 'StepController@edit');

Route::get('/steps/delete/{projectName}/{projectID}/{stepID}', 'StepController@delete');

Route::get('/steps/{projectName}/{projectID}/set/{stepID}/{action}', 'StepController@set');

Route::get('/steps/{projectName}/{projectID}/show/{stepID}', 'StepController@showDetailsStep');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
