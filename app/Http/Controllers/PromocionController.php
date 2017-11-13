<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller {
    /************************************ Funciones de Administrador sobre Promoción **************************************/
    public function registrarPromocion(Request $request) {
        $nombre = $request->input('nombre-promocion');
        $detalle = $request->input('detalle-promocion');
        $claveUnica = $request->input('clave-unica-promocion');
        $fechaInicio = $request->input('fecha-inicio-promocion');
        $fechaFin = $request->input('fecha-fin-promocion');
        $horaInicio = $request->input('hora-inicio-promocion');
        $horaFin = $request->input('hora-fin-promocion');
        $imagen = $request->file('imagen-promocion');

        $promocion = new Promocion();
        $promocion->nombre = $nombre;
        $promocion->detalle = $detalle;
        $promocion->clave_promocion_unica = 0;
        $promocion->fecha_inicio = $fechaInicio;
        $promocion->fecha_fin = $fechaFin;
        $promocion->hora_inicio = $horaInicio;
        $promocion->hora_fin = $horaFin;
        $promocion->id_estatus = 1;
        $promocion->save();

        //Guardar imagen
        $ruta = '/promociones/';
        $nombreImagen = $promocion->id . '-';

        $rutaServidor = ImageController::guardar($imagen, $ruta, $nombreImagen);

        $imagen = new Imagen();
        $imagen->ruta = $rutaServidor;
        $imagen->save();

        $promocion->id_imagen = $imagen->id;
        $promocion->save();

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
        $fechaInicio = $request->input('fecha-inicio');
        $fechaFin = $request->input('fecha-fin');
        $horaInicio = $request->input('hora-inicio');
        $horaFin = $request->input('hora-fin');
        $estatus = $request->input('select-estatus');

        $clase = Clase::withTrashed()->find($idClase);
        $clase->nombre = $nombre;
        $clase->detalle = $detalle;
        $clase->cupo_total = $cupoTotal;
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
}
