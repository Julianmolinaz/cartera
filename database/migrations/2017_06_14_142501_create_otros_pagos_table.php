<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtrosPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otros_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('cartera_id')->unsigned();
            $table->string('fecha_factura');
            $table->string('concepto');
            $table->double('valor_unitario');
            $table->double('cantidad');
            $table->double('subtotal');

            $table->timestamps();


            $table->foreign('factura_id')->references('id')->on('facturas');
            $table->foreign('cartera_id')->references('id')->on('carteras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('otros_pagos');
    }
}
