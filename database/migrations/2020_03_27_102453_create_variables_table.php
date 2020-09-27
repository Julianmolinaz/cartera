<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVariablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('variables', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('meses_min');
			$table->integer('meses_max');
			$table->integer('vlr_dia_sancion');
			$table->integer('vlr_estudio_tipico');
			$table->integer('vlr_estudio_domicilio');
			$table->string('razon_social')->nullable();
			$table->string('nit')->nullable();
			$table->string('telefono_1')->nullable();
			$table->string('telefono_2')->nullable();
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
		Schema::drop('variables');
	}

}
