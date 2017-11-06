<?php

namespace App\Http\Controllers;

use App\DatosUsuario;
use App\Direccion;
use App\Estatus;
use App\Telefono;
use App\User;
use Illuminate\Http\Request;

class ProfesorController extends Controller {
    /*********************************** Funciones de Administrador sobre Profesor ************************************/
    public function registrarProfesor(Request $request) {
        $email = $request->input('email-profe');
        $user = User::where('email', $email)->first();

        if (!isset($user)) {
            $user = new User();

            $user->email = $email;
            $user->password = bcrypt($request->input('password-profe'));
            $user->save();

            DatosUsuario::create([
                'id_usuario' => $user->id,
                'id_tipo_cuenta' => 3,
                'confirmacion_cuenta' => false,
                'id_estatus' => 1
            ]);

            Direccion::create([
                'id_usuario' => $user->id
            ]);

            Telefono::create([
                'id_usuario' => $user->id
            ]);

            return redirect()->to('/admin');
        } else {
            return redirect()->to('/admin')->with('errorProfe', 'Este correo ya está registrado');
        }
    }

    public function editarProfesor($idProfesor) {
        $usuario = User::withTrashed()->find($idProfesor);
        $estatus = Estatus::all();

        return view('profesor.editar', [
            'usuario' => $usuario,
            'estatus' => $estatus
        ]);
    }

    public function guardarProfesor(Request $request, $idProfesor) {
        $usuario = User::withTrashed()->find($idProfesor);
        $datosUsuario = $usuario->datosUsuario;
        $direccion = $usuario->direccion;
        $telefono = $usuario->telefono;

        //Cambios en usuario
        $email = $request->input('email');

        if ($usuario->email != $email) {
            $validar = $request->validate([
                'email' => 'required|string|email|max:255|unique:users'
            ]);
        }

        $usuario->email = $email;
        $usuario->save();

        //Cambios en datos
        $nombre = $request->input('nombre');
        $a_paterno = $request->input('apellido_paterno');
        $a_materno = $request->input('apellido_materno');
        $estatusUsuario = $request->input('select-estatus');

        $datosUsuario->nombre = $nombre;
        $datosUsuario->apellido_paterno = $a_paterno;
        $datosUsuario->apellido_materno = $a_materno;
        $datosUsuario->id_estatus = $estatusUsuario;
        $datosUsuario->save();

        //Cambios en dirección
        $cp = $request->input('codigo_postal');
        $calle = $request->input('calle');
        $colonia = $request->input('colonia');
        $mun = $request->input('municipio');
        $esta = $request->input('estado');

        $direccion->codigo_postal = $cp;
        $direccion->calle = $calle;
        $direccion->colonia = $colonia;
        $direccion->municipio = $mun;
        $direccion->estado = $esta;
        $direccion->save();

        //Cambios en teléfono
        $numTel = $request->input('telefono');

        $telefono->telefono = $numTel;
        $telefono->save();

        return redirect()->to('/admin');
    }

    public function eliminarProfesor($idProfesor) {
        $usuario = User::withTrashed()->find($idProfesor);
        $datosUsuario = $usuario->datosUsuario;
        $direccion = $usuario->direccion;
        $telefono = $usuario->telefono;

        $usuario->delete();
        $datosUsuario->delete();
        $direccion->delete();
        $telefono->delete();

        return redirect()->to('/admin');
    }

    public function recuperarProfesor($idProfesor) {
        $usuario = User::withTrashed()->find($idProfesor);
        $usuario->restore();

        $datosUsuario = $usuario->datosUsuario;
        $datosUsuario->restore();

        $direccion = $usuario->direccion;
        $direccion->restore();

        $telefono = $usuario->telefono;
        $telefono->restore();

        return redirect()->to('/admin/editar-profesor/' . $usuario->id);
    }
}
