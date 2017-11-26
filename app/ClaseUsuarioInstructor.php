<?php

namespace App;

use App\Mail\PagoClase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class ClaseUsuarioInstructor extends Model {
    use SoftDeletes;

    protected $table = 'clase_usuario_instructor';

    protected $fillable = [
        'id_clase',
        'id_usuario_instructor',
        'clave_asistencia_unica',
        'pagada'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    //Email pago
    public function enviarEmailPagoClase($email) {
        Mail::to($email)->send(new PagoClase($this));
    }

    //Funciones
    public static function generarClaveUnica() {
        return uniqid();
    }

    //Relaciones
    public function clase() {
        return $this->hasOne(Clase::class, 'id', 'id_clase');
    }

    public function usuario() {
        return $this->hasOne(User::class, 'id', 'id_usuario_instructor');
    }
}
