<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Promocion;
use App\Estatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $promocion->clave_promocion_unica = $claveUnica;
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

    public function editarPromocion($idPromocion) {
        $promocion = Promocion::withTrashed()->find($idPromocion);
        $estatus = Estatus::all();

        return view('promocion.editar', [
            'promocion' => $promocion,
            'estatus' => $estatus
        ]);
    }

    public function guardarPromocion(Request $request, $idPromocion) {
        $nombre = $request->input('nombre-promocion');
        $detalle = $request->input('detalle-promocion');
        $claveUnica = $request->input('clave-unica-promocion');
        $fechaInicio = $request->input('fecha-inicio-promocion');
        $fechaFin = $request->input('fecha-fin-promocion');
        $horaInicio = $request->input('hora-inicio-promocion');
        $horaFin = $request->input('hora-fin-promocion');
        $tieneImagen = $request->hasFile('imagen-promocion');
        $estatus = $request->input('select-estatus');

        $promocion = Promocion::withTrashed()->find($idPromocion);
        $promocion->nombre = $nombre;
        $promocion->detalle = $detalle;
        $promocion->clave_promocion_unica = $claveUnica;
        $promocion->fecha_inicio = $fechaInicio;
        $promocion->fecha_fin = $fechaFin;
        $promocion->hora_inicio = $horaInicio;
        $promocion->hora_fin = $horaFin;
        $promocion->id_estatus = $estatus;

        //Guardar imagen
        if ($tieneImagen) {
            $imagen = $request->file('imagen-promocion');
            $ruta = '/promociones/';
            $nombreImagen = $promocion->id . '-';

            $rutaServidor = ImageController::guardar($imagen, $ruta, $nombreImagen);

            $imagen = new Imagen();
            $imagen->ruta = $rutaServidor;
            $imagen->save();

            $promocion->id_imagen = $imagen->id;
        }

        $promocion->save();

        return redirect()->to('/admin');
    }

    public function eliminarPromocion($idPromocion) {
        $promocion = Promocion::withTrashed()->find($idPromocion);
        $imagen = $promocion->imagen;

        $imagen->delete();
        $promocion->delete();

        return redirect()->to('/admin');
    }

    public function recuperarPromocion($idPromocion) {
        $promocion = Promocion::withTrashed()->find($idPromocion);
        $imagen = $promocion->imagen;

        $promocion->restore();
        $imagen->restore();

        return redirect()->to('/admin');
    }

    public function enviarCorreo(Request $request) {
        $idPromocion = $request->input('id_promocion');
        $promocion = Promocion::find($idPromocion);
        $email = Auth::user()->email;

        $promocion->enviarEmailPromocion($email);

        return response()->json([
            'success' => true
        ]);
    }
}
