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
            $table->string('nombre');
            $table->string('prefijo')->nullable();
            $table->integer('increment')->default(0);
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->text('descripcion')->nullable();
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
