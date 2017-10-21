<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model {
    protected $table = 'pago';

    protected $fillable = [
        'id_usuario',
        'numero_tarjeta',
        'id_estatus'
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

    public function estatus() {
        return $this->hasOne(Estatus::class, 'id', 'id_estatus');
    }
}
