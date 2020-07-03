<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrecreditosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('precreditos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('num_fact')->unique();
			$table->string('fecha');
			$table->integer('cartera_id')->unsigned()->index('precreditos_cartera_id_foreign');
			$table->integer('funcionario_id')->unsigned()->index('precreditos_funcionario_id_foreign');
			$table->integer('cliente_id')->unsigned()->index('precreditos_cliente_id_foreign');
			$table->integer('producto_id')->unsigned()->index('precreditos_producto_id_foreign');
			$table->float('vlr_fin', 10, 0);
			$table->enum('periodo', array('Quincenal','Mensual'));
			$table->integer('meses');
			$table->integer('cuotas');
			$table->float('vlr_cuota', 10, 0);
			$table->string('p_fecha');
			$table->string('s_fecha')->nullable();
			$table->string('placa')->nullable(); // new
			$table->date('vencimiento_soat')->nullable(); // new
			$table->date('vencimiento_rtm')->nullable(); // new
			$table->enum('estudio', array('Tipico','Domicilio','Sin estudio'));
			$table->float('cuota_inicial', 10, 0)->nullable()->default(0);
			$table->enum('aprobado', array('Si','No','En estudio','Desistio'));
			$table->text('observaciones')->nullable();
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned()->nullable();

			$table->timestamps();

			$table->foreign('cartera_id')->references('id')->on('carteras')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('funcionario_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('producto_id')->references('id')->on('productos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::drop('precreditos');
	}

}
