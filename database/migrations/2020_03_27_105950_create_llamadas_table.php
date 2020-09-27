<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLlamadasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('llamadas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('credito_id')->unsigned()->index('llamadas_credito_id_foreign');
			$table->integer('criterio_id')->unsigned()->index('llamadas_criterio_id_foreign');
			$table->date('agenda')->nullable();
			$table->boolean('efectiva')->nullable()->comment('1 cuando la llamada es efectiva');
			$table->text('observaciones')->nullable();
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('credito_id')->references('id')->on('creditos')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('criterio_id')->references('id')->on('criterios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::drop('llamadas');
	}

}
