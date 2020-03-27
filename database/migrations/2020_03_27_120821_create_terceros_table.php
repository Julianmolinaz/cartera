<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTercerosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terceros', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('Llave primaria');
			$table->enum('tipo', array('Cliente','Empleado','General','Proveedor','Vendedor'));
			$table->enum('regimen', array('Estatal','Gran contribuyente','Regimen comun','Regimen especial','No responsable de IVA'))->comment('regimen tributario');
			$table->string('razon_social', 100)->nullable();
			$table->string('pnombre', 30)->nullable()->comment('primer nombre');
			$table->string('snombre', 30)->nullable()->comment('segundo nombre');
			$table->string('papellido', 30)->nullable()->comment('primer apellido');
			$table->string('sapellido', 30)->nullable()->comment('segundo apellido');
			$table->enum('tipo_doc', array('Cedula de ciudadania','Nit empresarial','Nit de extranjeria','Cedula de extranjeria'))->comment('tipo de documento');
			$table->string('num_doc', 11)->comment('número de documento');
			$table->integer('tel1')->comment('telefono 1');
			$table->integer('tel2')->comment('telefono dos');
			$table->string('dir', 100)->comment('direccion');
			$table->integer('mun_id')->unsigned()->index('fk_municipio');
			$table->string('email', 60);
			$table->integer('created_by')->unsigned();
			$table->integer('updated_by')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('mun_id')->references('id')->on('municipios');
			$table->foreign('created_by')->references('id')->on('users');
			$table->foreign('updated_by')->references('id')->on('users');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('terceros');
	}

}
