<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnotacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anotaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('proceso_id')->unsigned();
			$table->date('fecha_anotacion')->nullable();
			$table->string('asunto');
			$table->text('descripcion');
			$table->date('recordatorio')->nullable();
			$table->enum('notificado', array('Si','No','Espera'))->nullable()->default('No');
			$table->integer('user_create_id')->unsigned()->nullable();
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('user_create_id')->references('id')->on('users');
			$table->foreign('user_update_id')->references('id')->on('users');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('anotaciones');
	}

}
