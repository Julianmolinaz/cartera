<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('parentesco', ['Padre','Madre','Hermano/a','Tio/a','Nieto/a','Suegro/a','Cuñado/a','Primo/a','Sobrino/a','Abuelo/a','Hijo/a','Yerno','Nuera']);
            $table->string('direccion');
            $table->string('celular');
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
        Schema::drop('referencias');
    }
}
