<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuditoriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auditorias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('concepto', array('Sanciones'));
			$table->integer('clave_ini')->nullable();
			$table->integer('clave_fin')->nullable();
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
		Schema::drop('auditorias');
	}

}
