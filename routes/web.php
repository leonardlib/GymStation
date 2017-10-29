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

//Rutas administrador
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'AdminController@index');

    //Usuarios
    Route::post('/registro-usuario', 'AdminController@registrarUsuario');
    Route::get('/editar-usuario/{id}', 'AdminController@editarUsuario');
    Route::post('/guardar-usuario/{id}', 'AdminController@guardarUsuario');
    Route::get('/eliminar-usuario/{id}', 'AdminController@eliminarUsuario');
    Route::get('/recuperar-usuario/{id}', 'AdminController@recuperarUsuario');

    //Profesores
    Route::post('/registro-profesor', 'AdminController@registrarProfesor');
    Route::get('/editar-profesor/{id}', 'AdminController@editarProfesor');
    Route::post('/guardar-profesor/{id}', 'AdminController@guardarProfesor');
    Route::get('/eliminar-profesor/{id}', 'AdminController@eliminarProfesor');
    Route::get('/recuperar-profesor/{id}', 'AdminController@recuperarProfesor');
});
