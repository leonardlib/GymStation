<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCuenta extends Model {
    protected $table = 'tipo_cuenta';

    protected $fillable = [
        'tipo'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
