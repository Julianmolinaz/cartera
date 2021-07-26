<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSancionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sanciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('credito_id')->unsigned()->index('sanciones_credito_id_foreign');
			$table->float('valor', 10, 0);
			$table->enum('estado', array('Ok','Debe','Exonerada'));
			$table->integer('pago_id')->nullable();
			$table->timestamps();

			$table->foreign('credito_id')->references('id')->on('creditos')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sanciones');
	}

}
