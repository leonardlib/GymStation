<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostoPagoToClase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clase', function(Blueprint $table) {
            $table->float('costo', 10, 2);
            $table->float('pago_profesor', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clase', function(Blueprint $table) {
            $table->dropColumn('costo');
            $table->dropColumn('pago_profesor');
        });
    }
}
