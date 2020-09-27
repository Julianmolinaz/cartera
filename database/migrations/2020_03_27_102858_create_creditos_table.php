<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreditosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('creditos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('precredito_id')->unsigned()->index('creditos_precredito_id_foreign');
			$table->integer('cuotas_faltantes');
			$table->float('saldo', 10, 0)->nullable()->default(0);
			$table->float('saldo_favor', 10, 0)->nullable()->default(0);
			$table->enum('estado', array('Al dia','Mora','Prejuridico','Juridico','Cancelado','Cancelado por refinanciacion'));
			$table->float('rendimiento', 10, 0);
			$table->float('valor_credito', 10, 0);
			$table->enum('castigada', array('Si','No'))->nullable();
            $table->enum('refinanciacion', array('Si','No'))->default('No');
            $table->enum('calificacion', ['BB','B','M','MM','CASTIGADA'])->nullable();
			$table->integer('end_procredito');
			$table->integer('end_datacredito');
			$table->integer('credito_refinanciado_id')->unsigned()->nullable()->index('creditos_credito_refinanciado_id_foreign');
			$table->integer('last_llamada_id')->unsigned()->nullable()->index('creditos_last_llamada_id_foreign');
			$table->text('recordatorio')->nullable();
			$table->integer('sanciones_debe')->nullable()->default(0);
			$table->integer('sanciones_ok')->nullable()->default(0);
			$table->integer('sanciones_exoneradas')->nullable()->default(0);
			$table->enum('mes', array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'))->nullable()->comment('Mes de referencia para asignar comisiones');
			$table->integer('anio')->nullable();
			$table->boolean('permitir_mover_fecha')->default(0);
			
			$table->integer('user_create_id')->unsigned();
			$table->integer('user_update_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('credito_refinanciado_id')->references('id')->on('creditos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('precredito_id')->references('id')->on('precreditos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::drop('creditos');
	}

}
