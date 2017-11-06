<?php

namespace App\Http\Controllers;

use App\Clase;
use App\DatosUsuario;
use App\Direccion;
use App\Estatus;
use App\Pago;
use App\Telefono;
use App\TipoCuenta;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function index() {
        //Obtener usuarios
        $usuarios = DatosUsuario::with('usuario')->activos()->get();
        //Obtener promociones
        //Obtener profesores
        $profesores = DatosUsuario::with('usuario')->profesores()->get();
        //Obtener clases
        $clases = Clase::all();
        //Obtener tipos de cuenta
        $tiposCuenta = TipoCuenta::all();

        return view('admin.index', [
            'usuarios' => $usuarios,
            'profesores' => $profesores,
            'tiposCuenta' => $tiposCuenta,
            'clases' => $clases
        ]);
    }
}
