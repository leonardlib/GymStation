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
    $promociones = \App\Promocion::activas()->get();
    $clases = \App\Clase::activas()->get();
    $usuarios = \App\User::with('datosUsuario')->get();

    return view('welcome', [
        'promociones' => $promociones,
        'clases' => $clases,
        'usuarios' => $usuarios
    ]);
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

    //Promociones
    Route::post('/registro-promocion', 'PromocionController@registrarPromocion');
    Route::get('/editar-promocion/{id}', 'PromocionController@editarPromocion');
    Route::post('/guardar-promocion/{id}', 'PromocionController@guardarPromocion');
    Route::get('/eliminar-promocion/{id}', 'PromocionController@eliminarPromocion');
    Route::get('/recuperar-promocion/{id}', 'PromocionController@recuperarPromocion');
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

//Rutas generales de clase
Route::group(['prefix' => 'clase', 'middleware' => 'auth'], function () {
    Route::get('/buscar-usuario', 'ClaseController@buscarUsuario');
    Route::post('/registrar', 'ClaseController@registrarUsuario');
});
