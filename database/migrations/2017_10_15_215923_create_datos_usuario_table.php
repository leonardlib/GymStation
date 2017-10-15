<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->integer('id_tipo_cuenta')->unsigned();
            $table->boolean('confirmacion_cuenta');
            $table->integer('id_estatus')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            //Llaves foráneas
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_tipo_cuenta')->references('id')->on('tipo_cuenta');
            $table->foreign('id_estatus')->references('id')->on('estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_usuario');
    }
}
