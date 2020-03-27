<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProcesosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('procesos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('juzgado', 250)->nullable()->index('juzgado_id_2');
			$table->string('radicado', 100)->nullable();
			$table->date('fecha_radicado');
			$table->integer('credito_id')->unsigned()->index('credito_id');
			$table->integer('cliente_id')->unsigned()->index('cliente_id');
			$table->integer('user_create_id')->unsigned()->index('user_create_id');
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->date('created_at');
			$table->date('updated_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('procesos');
	}

}
