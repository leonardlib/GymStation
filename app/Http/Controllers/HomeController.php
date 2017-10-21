<?php

namespace App\Http\Controllers;

use App\DatosUsuario;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function admin() {
        //Obtener usuarios
        $usuarios = DatosUsuario::with('usuario')->activos()->get();
        //Obtener promociones
        //Obtener profesores

        return view('admin.index', [
            'usuarios' => $usuarios
        ]);
    }
}
