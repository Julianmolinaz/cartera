<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFactPrecreditosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fact_precreditos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('precredito_id')->unsigned()->index('fact_precreditos_precredito_id_foreign');
			$table->string('num_fact')->index('num_fact');
			$table->date('fecha');
			$table->float('total', 10, 0);
			$table->enum('tipo', array('Efectivo','Consignación'));
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->timestamps();

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
		Schema::drop('fact_precreditos');
	}

}
