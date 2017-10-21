<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relaciones
    public function datosUsuario() {
        return $this->hasOne(DatosUsuario::class, 'id_usuario', 'id');
    }

    public function telefono() {
        return $this->hasMany(Telefono::class, 'id_usuario', 'id');
    }

    public function pago() {
        return $this->hasMany(Pago::class, 'id_usuario', 'id');
    }

    public function direccion() {
        return $this->hasMany(Direccion::class, 'id_usuario', 'id');
    }
}
