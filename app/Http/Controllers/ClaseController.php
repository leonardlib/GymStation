<?php

namespace App\Http\Controllers;

use App\Clase;
use App\Estatus;
use Illuminate\Http\Request;

class ClaseController extends Controller {
    /************************************ Funciones de Administrador sobre Clase **************************************/
    public function registrarClase(Request $request) {
        $nombre = $request->input('nombre-clase');
        $detalle = $request->input('detalle-clase');
        $cupoTotal = $request->input('cupo-total');
        $fechaInicio = $request->input('fecha-inicio');
        $fechaFin = $request->input('fecha-fin');
        $horaInicio = $request->input('hora-inicio');
        $horaFin = $request->input('hora-fin');

        $clase = new Clase();
        $clase->nombre = $nombre;
        $clase->detalle = $detalle;
        $clase->cupo_actual = 0;
        $clase->cupo_total = $cupoTotal;
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
}
