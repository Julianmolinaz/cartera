<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePuntosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('puntos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('zona_id')->nullable();
			$table->string('nombre');
			$table->string('prefijo', 3)->nullable();
			$table->integer('increment')->nullable();
			$table->enum('estado', array('Activo','Inactivo'))->default('Activo');
			$table->string('direccion')->nullable();
			$table->string('telefono')->nullable();
			$table->text('descripcion')->nullable();
			$table->integer('municipio_id')->unsigned()->nullable()->index('puntos_municipio_id_foreign');
			$table->timestamps();

			$table->foreign('municipio_id')->references('id')->on('municipios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
