<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstudiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estudios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cliente_id')->unsigned()->nullable()->index('estudios_cliente_id_foreign');
			$table->integer('codeudor_id')->unsigned()->nullable()->index('estudios_codeudor_id_foreign');
			$table->integer('funcionario_id')->unsigned()->nullable()->index('estudios_funcionario_id_foreign');
			$table->integer('estDatacredito_id')->unsigned()->nullable()->index('estudios_estdatacredito_id_foreign');
			$table->integer('estLaboral_id')->unsigned()->nullable()->index('estudios_estlaboral_id_foreign');
			$table->integer('estVivienda_id')->unsigned()->nullable()->index('estudios_estvivienda_id_foreign');
			$table->integer('estReferencia_id')->unsigned()->nullable()->index('estudios_estreferencia_id_foreign');
			$table->float('cal_asesor', 10, 0)->nullable();
			$table->float('cal_estudio', 10, 0)->nullable();
			$table->text('observaciones')->nullable();
			$table->integer('user_create_id')->unsigned()->index('estudios_user_create_id_foreign');
			$table->integer('user_update_id')->unsigned()->index('estudios_user_update_id_foreign');
			
			$table->text('ref_1')->nullable()->comment('datos suministrados por la referencia');
			$table->text('ref_2')->nullable()->comment('datos suministrados por la referencia');
			$table->text('ref_3')->nullable()->comment('datos suministrados por la referencia');
			$table->text('ref_4')->nullable()->comment('datos suministrados por la referencia');

			$table->timestamps();

			$table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('codeudor_id')->references('id')->on('codeudores')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('estDatacredito_id')->references('id')->on('est_datacreditos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('estLaboral_id')->references('id')->on('est_laborales')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('estReferencia_id')->references('id')->on('est_referencias')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('estVivienda_id')->references('id')->on('est_viviendas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('funcionario_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::drop('estudios');
	}

}
