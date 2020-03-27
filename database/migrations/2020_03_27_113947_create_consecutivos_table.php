<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsecutivosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('consecutivos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('componente', 100);
			$table->string('prefijo', 10);
			$table->integer('incrementable');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('consecutivos');
	}

}
