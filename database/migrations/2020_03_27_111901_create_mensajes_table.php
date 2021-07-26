<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMensajesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mensajes', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->unique('id');
			$table->string('nombre')->unique('nombre');
			$table->enum('estado', array('1',''))->default('1');
			$table->string('mensaje');
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mensajes');
	}

}
