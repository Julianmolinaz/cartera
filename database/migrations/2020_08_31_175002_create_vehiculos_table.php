<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('placa')->nullable();
            $table->date('vencimiento_soat')->nullable();
            $table->date('vencimiento_rtm')->nullable();
            
            $table->integer('tipo_vehiculo_id')->unsigned();
            $table->foreign('tipo_vehiculo_id')->references('id')->on('tipo_vehiculos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vehiculos');
    }
}
