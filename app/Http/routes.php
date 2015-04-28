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
//|--------------------------------------------------------------------------
//| Ocorrências
//|--------------------------------------------------------------------------
Route::get('/ocorrencias/list/{situacao}', 'OcorrenciaController@index');

Route::get('/ocorrencias/show/{id}', 'OcorrenciaController@show');
Route::get('/ocorrencias/delete/{id}', 'OcorrenciaController@delete');

Route::get('/ocorrencias/add', 'OcorrenciaController@getAdd');
Route::post('/ocorrencias/add', 'OcorrenciaController@postAdd');
Route::post('/ocorrencias/upload', 'OcorrenciaController@upload');

Route::get('/ocorrencias/solicitante/{id}', 'OcorrenciaController@solicitante');

//|--------------------------------------------------------------------------
//| Viaturas
//|--------------------------------------------------------------------------
Route::get('/viaturas/update/{placa}', 'OcorrenciaController@updateViaturaPosition');


//|--------------------------------------------------------------------------
//| Solicitante
//|--------------------------------------------------------------------------
Route::get('/solicitantes', 'SolicitanteController@index');
Route::get('/solicitantes/show/{id}', 'SolicitanteController@show');
Route::post('/solicitantes/add', 'SolicitanteController@add');

Route::get('/', 'WelcomeController@index');
Route::post('/', 'WelcomeController@post');

Route::get('/oi/{n}', 'WelcomeController@oi');
Route::get('/oi', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
