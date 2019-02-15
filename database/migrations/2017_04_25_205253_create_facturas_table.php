<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credito_id')->unsigned()->nullable();
            $table->string('num_fact');
            $table->string('fecha');
            $table->double('total');
            $table->enum('tipo',['Efectivo','Consignacion']);
            $table->enum('banco',['Banco Agrario','Banco AV Villas','Banco Caja Social','Banco de Occidente','Banco Popular','Bancóldex','Bancolombia','BBVA','Banco de Bogotá','Citi','Colpatria','Davivienda','GNB Sudameris']);
            $table->date('fecha_proximo_pago');
            $table->integer('user_create_id')->unsigned();
            $table->integer('user_update_id')->unsigned();
            $table->timestamps();

            $table->foreign('credito_id')
                ->references('id')->on('creditos');

            $table->foreign('user_create_id')
                ->references('id')->on('users');
                
            $table->foreign('user_update_id')
                ->references('id')->on('users');
                   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('facturas');
    }
}
