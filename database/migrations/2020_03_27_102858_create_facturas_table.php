<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacturasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facturas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('credito_id')->unsigned()->nullable()->index('facturas_credito_id_foreign');
			$table->string('num_fact');
			$table->string('fecha');
			$table->string('ref')->nullable()->comment('Numero de facturacion aceptado por la DIAN');
			$table->float('total', 10, 0);
			$table->enum('tipo', array('Efectivo','Consignacion'));
			$table->enum('banco', array('Baloto','Banco Agrario','Banco AV Villas','Banco Caja Social','Banco de Occidente','Banco Popular','Bancóldex','Bancolombia','BBVA','Banco de Bogotá','Citi','Colpatria','Davivienda','Gana Gana','GNB Sudameris','Apostar'))->nullable();
			$table->string('num_consignacion', 100)->nullable()->comment('Numero de factura de consignación');
			$table->date('fecha_proximo_pago')->nullable();
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('credito_id')->references('id')->on('creditos')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
		Schema::drop('facturas');
	}

}
