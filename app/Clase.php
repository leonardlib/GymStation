<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clase extends Model {
    use SoftDeletes;

    protected $table = 'clase';

    protected $fillable = [
        'nombre',
        'detalle',
        'cupo_actual',
        'cupo_total',
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

    //Scope
    public function scopeTodas($query) {
        return $query->withTrashed()->get();
    }

    public function scopeActivas($query) {
        return $query->where('id_estatus', 1);
    }

    //Relaciones
    public function estatus() {
        return $this->hasOne(Estatus::class, 'id', 'id_estatus');
    }

    public function claseUsuarioInstructor() {
        return $this->hasMany(ClaseUsuarioInstructor::class, 'id_clase', 'id')->withTrashed();
    }
}
