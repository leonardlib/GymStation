<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosUsuario extends Model {
    protected $table = 'datos_usuario';

    protected $fillable = [
        'id_usuario',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'id_tipo_cuenta',
        'confirmacion_cuenta',
        'id_estatus'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    //Scopes
    public function scopeActivos($query) {
        return $query->where('id_estatus', 1);
    }

    //Relaciones
    public function usuario() {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }

    public function tipoCuenta() {
        return $this->hasOne(TipoCuenta::class, 'id', 'id_tipo_cuenta');
    }

    public function estatus() {
        return $this->hasOne(Estatus::class, 'id', 'id_estatus');
    }
}
