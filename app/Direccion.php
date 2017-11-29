<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model {
    use SoftDeletes;

    protected $table = 'direccion';

    protected $fillable = [
        'id_usuario',
        'calle',
        'colonia',
        'municipio',
        'estado',
        'codigo_postal'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    //funciones
    public function direccionCompleta() {
        if ($this->calle) {
            return $this->calle . ', ' . $this->colonia . ', ' . $this->municipio . ', ' . $this->estado . ', C.P.: ' . $this->codigo_postal;
        } else {
            return 'Sin dirección';
        }
    }

    //Relaciones
    public function usuario() {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
}
