<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecredPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precred_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fact_precredito_id')->unsigned();
            $table->integer('concepto_id')->unsigned();
            $table->integer('precredito_id')->unsigned();
            $table->double('valor');
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('fact_precredito_id')->references('id')->on('fact_precreditos');
            $table->foreign('concepto_id')->references('id')->on('fact_precred_conceptos');
            $table->foreign('precredito_id')->references('id')->on('precreditos');
            $table->foreign('user_create_id')->references('id')->on('users');
            $table->foreign('user_update_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('precred_pagos');
    }
}
