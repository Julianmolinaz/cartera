<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('orden');
            $table->string('concepto');
            $table->double('valor');
            $table->enum('estado', ['Activo','Inactivo'])->default('Activo');
            
            
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
            
            $table->integer('tipo_vehiculo_id')->unsigned();           
            $table->foreign('tipo_vehiculo_id')->references('id')->on('tipo_vehiculos');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tarifas');
    }
}
