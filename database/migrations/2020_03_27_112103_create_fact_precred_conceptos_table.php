<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFactPrecredConceptosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fact_precred_conceptos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->enum('estado', array('Activo','Inactivo'))->nullable()->default('Activo');
			$table->float('valor', 10, 0)->nullable();
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
		Schema::drop('fact_precred_conceptos');
	}

}
