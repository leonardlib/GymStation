<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estatus extends Model {
    protected $table = 'estatus';

    protected $fillable = [
        'estatus'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
