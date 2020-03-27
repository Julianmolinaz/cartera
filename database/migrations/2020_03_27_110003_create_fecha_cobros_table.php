<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFechaCobrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fecha_cobros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('credito_id')->unsigned()->index('fecha_cobros_credito_id_foreign');
			$table->date('fecha_pago');
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
		Schema::drop('fecha_cobros');
	}

}
