<?php

namespace App\Http\Controllers;

use App\DatosUsuario;
use App\Direccion;
use App\Estatus;
use App\Pago;
use App\Telefono;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UsuarioController extends Controller {
    public function index() {
        //Obtener usuarios
        $datosUsuario = Auth::user()->datosUsuario;
        //Obtener clases
        $clases = Auth::user()->clases;
        //Obtener estatus
        $estatus = Estatus::all();

        return view('usuario.index', [
            'datosUsuario' => $datosUsuario,
            'clases' => $clases,
            'estatus' => $estatus
        ]);
    }

    /********************************** Funciones de Administrador sobre Usuario ***************************************/
    public function registrarUsuario(Request $request) {
        $validar = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();

        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        DatosUsuario::create([
            'id_usuario' => $user->id,
            'id_tipo_cuenta' => 2,
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

        $user->enviarCorreoConfirmacion();

        return redirect()->to('/admin');
    }

    public function editarUsuario($idUsuario) {
        $usuario = User::withTrashed()->find($idUsuario);
        $estatus = Estatus::all();

        return view('usuario.editar', [
            'usuario' => $usuario,
            'estatus' => $estatus
        ]);
    }

    public function guardarUsuario(Request $request, $idUsuario) {
        $usuario = User::withTrashed()->find($idUsuario);
        $datosUsuario = $usuario->datosUsuario;
        $direccion = $usuario->direccion;
        $telefono = $usuario->telefono;
        $pago = $usuario->pago;

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
        $datosUsuario->id_estatus = ($estatusUsuario) ? $estatusUsuario : 1;
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

        //Cambios en pago
        $estatusPago = $request->input('select-estatus-pago');

        $pago->id_estatus = $estatusPago;
        $pago->save();

        if (Auth::user()->datosUsuario->tipoCuenta->tipo == 'administrador') {
            return redirect()->to('/admin');
        } else {
            return redirect()->to('/usuario');
        }
    }

    public function eliminarUsuario($idUsuario) {
        $usuario = User::withTrashed()->find($idUsuario);
        $datosUsuario = $usuario->datosUsuario;
        $direccion = $usuario->direccion;
        $telefono = $usuario->telefono;
        $pago = $usuario->pago;

        $usuario->delete();
        $datosUsuario->delete();
        $direccion->delete();
        $telefono->delete();
        $pago->delete();

        return redirect()->to('/admin');
    }

    public function recuperarUsuario($idUsuario) {
        $usuario = User::withTrashed()->find($idUsuario);
        $usuario->restore();

        $datosUsuario = $usuario->datosUsuario;
        $datosUsuario->restore();

        $direccion = $usuario->direccion;
        $direccion->restore();

        $telefono = $usuario->telefono;
        $telefono->restore();

        $pago = $usuario->pago;
        $pago->restore();

        return redirect()->to('/admin/editar-usuario/' . $usuario->id);
    }

    public function confirmarUsuario($idUsuario) {
        $usuario = User::withTrashed()->find($idUsuario);
        $datosUsuario = $usuario->datosUsuario;

        $datosUsuario->confirmacion_cuenta = true;
        $datosUsuario->save();
        session()->forget('confirmado');
        session()->forget('registrado');

        return redirect()->to('/usuario');
    }

    public function reportePDF(Request $request) {
        $fecha_inicio = $request->input('fecha-inicio-reporte');
        $fecha_fin = $request->input('fecha-fin-reporte');

        $usuarios = User::with(['datosUsuario', 'telefono', 'direccion'])
                            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
                            ->get();
        $data = [];

        foreach ($usuarios as $usuario) {
            $dato = [
                'email' => $usuario->email,
                'nombre' => $usuario->datosUsuario->nombreCompleto(),
                'direccion' => $usuario->direccion->direccionCompleta(),
                'telefono' => ($usuario->telefono->telefono) ? $usuario->telefono->telefono : 'Sin teléfono'
            ];

            array_push($data, $dato);
        }

        $view =  View::make('pdf.invoice',
            compact(
                'data', 'fecha_inicio', 'fecha_fin'
            )
        )->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('invoice');
    }
}
