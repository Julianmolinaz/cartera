<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->enum('estado', ['Activo','Inactivo'])->default('Activo');
            $table->enum('rol', ['Administrador','Asesor','Asesor VIP','Cartera','Recaudador','Call']);
            $table->integer('rol_id')->unsigned()->nullable();
            // $table->foreign('roles')->references('id')->on('roles')->nullable();
			$table->string('email')->unique();
			$table->string('password');
			$table->integer('punto_id')->unsigned();
			$table->string('num_cuenta', 122)->nullable()->comment('numero de cuenta nomina');
			$table->integer('banco_id')->nullable()->comment('referencia a bancos');
			$table->string('remember_token', 100)->nullable();
			
			$table->timestamps();

			$table->foreign('punto_id')->references('id')->on('puntos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
