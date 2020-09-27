<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarteraNegocioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cartera_negocio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cartera_id')->unsigned();
			$table->integer('negocio_id')->unsigned();

			$table->foreign('cartera_id')->references('id')->on('carteras');
			$table->foreign('negocio_id')->references('id')->on('negocios');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cartera_negocio');
	}

}
