<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('extras', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fecha');
			$table->enum('concepto', array('Prejuridico','Juridico'));
			$table->enum('estado', array('Ok','Debe','Finalizado'));
			$table->float('valor', 10, 0);
			$table->text('descripcion')->nullable();
			$table->integer('credito_id')->unsigned();
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('credito_id')->references('id')->on('creditos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_create_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_update_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('extras');
	}

}
