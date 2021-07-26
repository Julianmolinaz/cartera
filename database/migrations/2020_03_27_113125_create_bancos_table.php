<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBancosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bancos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->enum('estado', array('Activo','Inactivo'))->nullable()->default('Activo');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bancos');
	}

}
