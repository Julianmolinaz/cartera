<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarterasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carteras', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre')->unique();
			$table->enum('estado', array('Activo','Inactivo'))->default('Activo');
			$table->decimal('porcentaje_pago_parcial', 10, 0)->nullable()->comment('porcentaje aplicado al valor de la cuota de un credito para permitir el pago de cuotas parciales');
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
		Schema::drop('carteras');
	}

}
