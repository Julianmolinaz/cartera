<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->increments('id');
		    $table->integer('zona_id')->nullable();
		    $table->string('nombre', 255);
		    $table->string('prefijo', 3)->nullable();
		    $table->integer('increment')->nullable();
		    $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
		    $table->string('direccion', 255)->nullable();
		    $table->string('telefono', 255)->nullable();
		    $table->text('descripcion');
		    $table->integer('municipio_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('municipio_id')->references('id')->on('municipios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('puntos');
    }
}
