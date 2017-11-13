<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promocion extends Model {
    use SoftDeletes;

    protected $table = 'promocion';

    protected $fillable = [
        'nombre',
        'detalle',
        'clave_promocion_unica',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'id_estatus'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    //Relaciones
    public function estatus() {
        return $this->hasOne(Estatus::class, 'id', 'id_estatus');
    }

    public function imagen() {
        return $this->hasOne(Imagen::class, 'id', 'id_imagen');
    }
}
