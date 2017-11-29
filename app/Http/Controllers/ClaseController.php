<?php

namespace App\Http\Controllers;

use App\Clase;
use App\ClaseUsuarioInstructor;
use App\Estatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ClaseController extends Controller {
    /************************************ Funciones de Administrador sobre Clase **************************************/
    public function registrarClase(Request $request) {
        $nombre = $request->input('nombre-clase');
        $detalle = $request->input('detalle-clase');
        $cupoTotal = $request->input('cupo-total');
        $costo = $request->input('costo');
        $pagoProfesor = $request->input('pago-profesor');
        $fechaInicio = $request->input('fecha-inicio');
        $fechaFin = $request->input('fecha-fin');
        $horaInicio = $request->input('hora-inicio');
        $horaFin = $request->input('hora-fin');

        $clase = new Clase();
        $clase->nombre = $nombre;
        $clase->detalle = $detalle;
        $clase->cupo_actual = 0;
        $clase->cupo_total = $cupoTotal;
        $clase->costo = $costo;
        $clase->pago_profesor = $pagoProfesor;
        $clase->fecha_inicio = $fechaInicio;
        $clase->fecha_fin = $fechaFin;
        $clase->hora_inicio = $horaInicio;
        $clase->hora_fin = $horaFin;
        $clase->id_estatus = 1;
        $clase->save();

        return redirect()->to('/admin');
    }

    public function editarClase($idClase) {
        $clase = Clase::withTrashed()->find($idClase);
        $estatus = Estatus::all();

        return view('clase.editar', [
            'clase' => $clase,
            'estatus' => $estatus
        ]);
    }

    public function guardarClase(Request $request, $idClase) {
        $nombre = $request->input('nombre-clase');
        $detalle = $request->input('detalle-clase');
        $cupoTotal = $request->input('cupo-total');
        $costo = $request->input('costo');
        $pagoProfesor = $request->input('pago-profesor');
        $fechaInicio = $request->input('fecha-inicio');
        $fechaFin = $request->input('fecha-fin');
        $horaInicio = $request->input('hora-inicio');
        $horaFin = $request->input('hora-fin');
        $estatus = $request->input('select-estatus');

        $clase = Clase::withTrashed()->find($idClase);
        $clase->nombre = $nombre;
        $clase->detalle = $detalle;
        $clase->cupo_total = $cupoTotal;
        $clase->costo = $costo;
        $clase->pago_profesor = $pagoProfesor;
        $clase->fecha_inicio = $fechaInicio;
        $clase->fecha_fin = $fechaFin;
        $clase->hora_inicio = $horaInicio;
        $clase->hora_fin = $horaFin;
        $clase->id_estatus = $estatus;
        $clase->save();

        return redirect()->to('/admin');
    }

    public function eliminarClase($idClase) {
        $clase = Clase::withTrashed()->find($idClase);
        $claseUsuarioInstructor = $clase->claseUsuarioInstructor;

        foreach ($claseUsuarioInstructor as $claseUsuIns) {
            $claseUsuIns->delete();
        }
        $clase->delete();

        return redirect()->to('/admin');
    }

    public function recuperarClase($idClase) {
        $clase = Clase::withTrashed()->find($idClase);
        $claseUsuarioInstructor = $clase->claseUsuarioInstructor;

        $clase->restore();
        foreach ($claseUsuarioInstructor as $claseUsuIns) {
            $claseUsuIns->restore();
        }

        return redirect()->to('/admin');
    }

    public function buscarUsuario(Request $request) {
        $parametro = $request->input('parametro');

        $usuarios = User::with('datosUsuario')
                        ->where('email', 'like', '%' . $parametro . '%')
                        ->get();

        return response()->json($usuarios);
    }

    public function registrarUsuario(Request $request) {
        $idClase = $request->input('id_clase');
        $idUsuario = $request->input('id_usuario');
        $clase = Clase::find($idClase);

        $claseUsuarioInstructor = ClaseUsuarioInstructor::where('id_clase', $idClase)
                                                        ->where('id_usuario_instructor', $idUsuario)
                                                        ->first();

        if (!isset($claseUsuarioInstructor) && $clase->cupo_actual < ($clase->cupo_total + 1)) {
            $clave = ClaseUsuarioInstructor::generarClaveUnica();

            $nuevaClaseUsuarioInstructor = new ClaseUsuarioInstructor();
            $nuevaClaseUsuarioInstructor->id_clase = $idClase;
            $nuevaClaseUsuarioInstructor->id_usuario_instructor = $idUsuario;
            $nuevaClaseUsuarioInstructor->clave_asistencia_unica = $clave;
            $nuevaClaseUsuarioInstructor->pagada = false;
            $nuevaClaseUsuarioInstructor->save();

            $clase->cupo_actual++;
            $clase->save();

            return response()->json(array(
                'success' => true,
                'cupo_actual' => $clase->cupo_actual,
                'cupo_total' => $clase->cupo_total
            ));
        } else {
            return response()->json(array(
                'success' => false
            ));
        }
    }

    public function reportePDF($idClase) {
        $asistencias = ClaseUsuarioInstructor::with(['clase', 'usuario'])
                                                ->where('id_clase', $idClase)
                                                ->get();
        $data = [];

        foreach ($asistencias as $asistencia) {
            $clase = $asistencia->clase->nombre;
            $costo = $asistencia->clase->costo;
            $pago = $asistencia->clase->pago_profesor;

            $dato = [
                'email' => $asistencia->usuario->email,
                'nombre' => $asistencia->usuario->datosUsuario->nombreCompleto(),
                'direccion' => $asistencia->usuario->direccion->direccionCompleta(),
                'telefono' => ($asistencia->usuario->telefono->telefono) ? $asistencia->usuario->telefono->telefono : 'Sin teléfono',
                'pagada' => ($asistencia->pagada) ? 'Pagada' : 'No pagada'
            ];

            array_push($data, $dato);
        }

        $view =  View::make('pdf.invoiceClase',
            compact('data', 'clase', 'costo', 'pago')
        )->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('invoice');
    }
}
