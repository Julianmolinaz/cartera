<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('ruta');
			$table->integer('cliente_id')->unsigned()->nullable()->index('documentos_cliente_id_foreign');
			$table->integer('precredito_id')->unsigned()->nullable()->index('documentos_precredito_id_foreign');
			$table->integer('credito_id')->unsigned()->nullable()->index('documentos_credito_id_foreign');
			$table->integer('user_create_id')->unsigned()->index('documentos_user_create_id_foreign');
			$table->timestamps();

			$table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('credito_id')->references('id')->on('creditos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('precredito_id')->references('id')->on('precreditos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::drop('documentos');
	}

}
