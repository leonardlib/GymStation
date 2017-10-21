<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model {
    protected $table = 'telefono';

    protected $fillable = [
        'id_usuario',
        'telefono'
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
