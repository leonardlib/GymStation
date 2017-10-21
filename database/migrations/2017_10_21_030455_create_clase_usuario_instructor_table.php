<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaseUsuarioInstructorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clase_usuario_instructor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_clase')->unsigned();
            $table->integer('id_usuario_instructor')->unsigned();
            $table->string('clave_asistencia_unica')->nullable();
            $table->boolean('pagada')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //Llave foránea
            $table->foreign('id_usuario_instructor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clase_usuario_instructor');
    }
}
