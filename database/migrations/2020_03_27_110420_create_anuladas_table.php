<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnuladasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anuladas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cliente_id')->unsigned()->index('anuladas_cliente_id_foreign');
			$table->integer('factura_id');
			$table->integer('credito_id')->unsigned()->nullable()->index('anuladas_credito_id_foreign');
			$table->integer('precredito_id')->unsigned()->nullable();
			$table->string('num_fact');
			$table->string('fecha');
			$table->float('total', 10, 0);
			$table->text('pagos')->nullable();
			$table->text('motivo_anulacion', 65535)->nullable();
			$table->integer('user_anula')->unsigned()->index('anuladas_user_anula_foreign');
			$table->integer('user_create_id')->unsigned()->index('anuladas_user_create_id_foreign');
			$table->timestamps();

			$table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('credito_id')->references('id')->on('creditos')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_anula')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_create_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('anuladas');
	}

}
