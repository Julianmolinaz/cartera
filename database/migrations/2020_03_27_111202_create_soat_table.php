<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soat', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cliente_id')->unsigned()->nullable()->index('soat_cliente_id_foreign');
			$table->integer('codeudor_id')->unsigned()->nullable()->index('soat_codeudor_id_foreign');
			$table->string('placa')->nullable();
			$table->enum('tipo', array('cliente','codeudor'));
			$table->date('vencimiento');
			$table->integer('user_create_id')->unsigned()->index('soat_user_create_id_foreign');
			$table->integer('user_update_id')->unsigned()->index('soat_user_update_id_foreign');
			$table->timestamps();

			$table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('codeudor_id')->references('id')->on('codeudores')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::drop('soat');
	}

}
