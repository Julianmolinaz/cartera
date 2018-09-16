<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConyugesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('conyuges', function (Blueprint $table) {

          $table->increments('id');
          $table->string('nombrey');
          $table->string('p_nombrey');
          $table->string('s_nombrey')->nullable();
          $table->string('p_apellidoy');
          $table->string('s_apellidoy')->nullable();
          $table->enum('tipo_docy',[
             'Cedula Ciudadanía',
             'Nit',
             'Cedula de Extranjería',
             'Pasaporte',
             'Pase Diplomático',
             'Carnet Diplomático',
             'Tarjeta de Identidad',
             'Rut',
             'Número único de Identificación Personal',
             'Nit de Extranjería'])
          ->default('Cedula Ciudadanía');
          $table->string('num_docy');
          $table->string('diry');
          $table->string('movily');
          $table->string('fijoy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conyuges');
    }
}
