<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zonas', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->string('nombre', 100);
			$table->text('descripcion')->nullable();
			$table->integer('user_create_id')->unsigned()->index('user_create_id');
			$table->integer('user_update_id')->unsigned()->nullable()->index('user_update_id');
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
		Schema::drop('zonas');
	}

}
