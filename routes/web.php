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
    Route::post('/registro-usuario', 'UsuarioController@registrarUsuario');
    Route::get('/editar-usuario/{id}', 'UsuarioController@editarUsuario');
    Route::post('/guardar-usuario/{id}', 'UsuarioController@guardarUsuario');
    Route::get('/eliminar-usuario/{id}', 'UsuarioController@eliminarUsuario');
    Route::get('/recuperar-usuario/{id}', 'UsuarioController@recuperarUsuario');

    //Profesores
    Route::post('/registro-profesor', 'ProfesorController@registrarProfesor');
    Route::get('/editar-profesor/{id}', 'ProfesorController@editarProfesor');
    Route::post('/guardar-profesor/{id}', 'ProfesorController@guardarProfesor');
    Route::get('/eliminar-profesor/{id}', 'ProfesorController@eliminarProfesor');
    Route::get('/recuperar-profesor/{id}', 'ProfesorController@recuperarProfesor');

    //Clases
    Route::post('/registro-clase', 'ClaseController@registrarClase');
    Route::get('/editar-clase/{id}', 'ClaseController@editarClase');
    Route::post('/guardar-clase/{id}', 'ClaseController@guardarClase');
    Route::get('/eliminar-clase/{id}', 'ClaseController@eliminarClase');
    Route::get('/recuperar-clase/{id}', 'ClaseController@recuperarClase');
});

//Rutas usuario normal
Route::group(['prefix' => 'usuario', 'middleware' => 'auth'], function () {
    Route::get('/', 'UsuarioController@index');

    //Usuarios
    Route::post('/registro-usuario', 'UsuarioController@registrarUsuario');
    Route::get('/editar-usuario/{id}', 'UsuarioController@editarUsuario');
    Route::post('/guardar-usuario/{id}', 'UsuarioController@guardarUsuario');
    Route::get('/eliminar-usuario/{id}', 'UsuarioController@eliminarUsuario');
    Route::get('/recuperar-usuario/{id}', 'UsuarioController@recuperarUsuario');
});
