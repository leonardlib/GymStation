<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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
        return $this->hasOne(DatosUsuario::class, 'id_usuario', 'id')->withTrashed();
    }

    public function telefono() {
        return $this->hasOne(Telefono::class, 'id_usuario', 'id')->withTrashed();
    }

    public function pago() {
        return $this->hasOne(Pago::class, 'id_usuario', 'id')->withTrashed();
    }

    public function direccion() {
        return $this->hasOne(Direccion::class, 'id_usuario', 'id')->withTrashed();
    }

    public function clases() {
        return $this->hasMany(ClaseUsuarioInstructor::class, 'id_usuario_instructor', 'id')->withTrashed();
    }
}
