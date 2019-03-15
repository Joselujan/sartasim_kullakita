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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/sign_in', 'HomeController@verificar')->name('sign_in');

/////////////PARA SUBIR FOTO DE PERFIL
//muestra el perfil
Route::get('/profile', 'UserController@profile')->name('user.profile');
//edita el perfil
Route::post('/profile', 'UserController@update_profile')->name('user.profile.update');

///PARA REGISTRAR DATOS DE PERSONA
Route::post('personas'.'PersonaController');
