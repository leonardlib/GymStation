<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model {
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

    //Relaciones
    public function usuario() {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
}
