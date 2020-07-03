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
            $table->string('producto_id');
            $table->string('tipo_vehiculo_id');
            $table->string('cilindraje_id');
            $table->double('valor');
            $table->enum('modelo',[ 'Menor a 10 años', 'Mayor a 10 años'])->nulable();
            $table->enum('estado', ['Activo','Inactivo'])->default('Activo');
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
