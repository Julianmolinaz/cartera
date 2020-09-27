<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProveedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedores', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre');
			$table->enum('estado', array('Activo','Inactivo'))->nullable()->default('Activo');
			$table->enum('tipo_doc', array('Cedula Ciudadanía','Nit','Cedula de Extranjería','Pasaporte','Pase Diplomático','Carnet Diplomático','Tarjeta de Identidad','Rut','Número único de Identificación Personal','Nit de Extranjería'))->nullable();
			$table->string('num_doc', 100)->nullable()->unique('num_doc');
			$table->string('telefono', 100)->nullable();
			$table->string('direccion')->nullable();
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->nullable()->unsigned();
			$table->timestamps();

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
		Schema::drop('proveedores');
	}

}
