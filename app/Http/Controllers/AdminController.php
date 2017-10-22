<?php

namespace App\Http\Controllers;

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
        //Obtener tipos de cuenta
        $tiposCuenta = TipoCuenta::all();

        return view('admin.index', [
            'usuarios' => $usuarios,
            'tiposCuenta' => $tiposCuenta
        ]);
    }

    public function registrarUsuario(Request $request, $tipo) {
        $validar = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();

        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        DatosUsuario::create([
            'id_usuario' => $user->id,
            'id_tipo_cuenta' => $tipo,
            'confirmacion_cuenta' => false,
            'id_estatus' => 1
        ]);

        Direccion::create([
            'id_usuario' => $user->id
        ]);

        Pago::create([
            'id_usuario' => $user->id,
            'id_estatus' => 1
        ]);

        Telefono::create([
            'id_usuario' => $user->id
        ]);

        return redirect()->to('/admin');
    }

    public function editarUsuario(Request $request, $idUsuario) {
        $usuario = User::find($idUsuario);
        $tiposCuenta = TipoCuenta::all();
        $estatus = Estatus::all();

        return view('usuario.editar', [
            'usuario' => $usuario,
            'tiposCuenta' => $tiposCuenta,
            'estatus' => $estatus
        ]);
    }
}
