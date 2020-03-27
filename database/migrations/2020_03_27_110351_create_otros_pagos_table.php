<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOtrosPagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('otros_pagos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('factura_id')->unsigned();
			$table->integer('cartera_id')->unsigned();
			$table->string('fecha_factura');
			$table->string('concepto');
			$table->float('valor_unitario', 10, 0);
			$table->float('cantidad', 10, 0);
			$table->float('subtotal', 10, 0);
			$table->timestamps();

			$table->foreign('cartera_id')->references('id')->on('carteras')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('factura_id')->references('id')->on('facturas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('otros_pagos');
	}

}
