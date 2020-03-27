<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrecredPagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('precred_pagos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('fact_precredito_id')->unsigned()->index('precred_pagos_fact_precredito_id_foreign');
			$table->integer('concepto_id')->unsigned()->index('precred_pagos_concepto_id_foreign');
			$table->integer('precredito_id')->unsigned()->index('precred_pagos_precredito_id_foreign');
			$table->float('subtotal', 10, 0);
			$table->integer('user_create_id')->unsigned()->index('precred_pagos_user_create_id_foreign');
			$table->integer('user_update_id')->unsigned()->nullable()->index('precred_pagos_user_update_id_foreign');
			$table->timestamps();

			$table->foreign('concepto_id')->references('id')->on('fact_precred_conceptos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('fact_precredito_id')->references('id')->on('fact_precreditos')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('precredito_id')->references('id')->on('precreditos')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::drop('precred_pagos');
	}

}
