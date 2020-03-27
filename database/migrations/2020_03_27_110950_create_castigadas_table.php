<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCastigadasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('castigadas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('credito_id')->unsigned()->index('castigadas_credito_id_foreign');
			$table->date('fecha_limite');
			$table->float('saldo', 10, 0);
			$table->integer('user_create_id')->unsigned()->index('castigadas_user_create_id_foreign');
			$table->integer('user_update_id')->unsigned()->index('castigadas_user_update_id_foreign');
			$table->timestamps();

			$table->foreign('credito_id')->references('id')->on('creditos')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::drop('castigadas');
	}

}
